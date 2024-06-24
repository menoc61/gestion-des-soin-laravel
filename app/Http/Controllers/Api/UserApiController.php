<?php

namespace App\Http\Controllers\Api;

use App\Appointment;
use App\Billing;
use App\Document;
use App\History;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Prescription;
use App\Test;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserApiController extends Controller
{
    public function GetUser(Request $request)
    {
        if ($request->user()) {
            $user = $request->user();

            return response()->json(['success' => true, 'user' => $user], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
    }

    public function RegisterUser(Request $request)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string'],
                'role_id' => ['numeric'],
            ]);

            // Check if user already exists
            // $existingUser = User::where('email', $request->email)->first();

            // if ($existingUser) {
            //     return response()->json(['message' => 'User already exists'], 200);
            // }

            if ($validatedData->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vous avez oublié un champ',
                    'error' => $validatedData->errors(),
                ], 401);
            } else {
                $user = new User();
                $user->password = \Hash::make($request->password);
                $user->email = $request->email;
                $user->name = $request->name;
                $user->role_id = $request->role_id ?? 3;
                $user->save();

                $patient = new Patient();
                $patient->user_id = $user->id;
                $patient->phone = $request->phone;
                $patient->gender = $request->gender;
                $patient->birthday = $request->birthday ?? '00-00-0000';
                $patient->adress = $request->adress;
                $patient->allergie = $request->allergie ?? 'Aucune';
                $patient->medication = $request->medication ?? 'Aucune';
                $patient->hobbie = $request->hobbie ?? 'Aucun';
                $patient->demande = $request->demande ?? 'Aucune';
                $patient->type_patient = $request->type_patient ? json_encode($request->type_patient) : json_encode(['Aucun']);
                $patient->morphology = $request->morphology ? json_encode($request->morphology) : json_encode(['Aucune']);
                $patient->alimentation = $request->alimentation ? json_encode($request->alimentation) : json_encode(['Aucune']);
                $patient->digestion = $request->digestion ?? 'Aucune';
                $patient->save();

                $role = Role::findById($user->role_id);

                if ($role) {
                    $user->assignRole($role);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Le rôle ID spécifié n\'existe pas',
                    ], 404);
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Utilisateur créé avec succès',
                    'token' => $user->createToken('api token')->plainTextToken,
                ], 200);
            }
        } catch (\Throwable $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function LoginUser(Request $request)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'email' => ['required', 'email'],
                'password' => 'required',
            ]);
            if ($validatedData->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de Validation',
                    'error' => $validatedData->errors(),
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'cet utilisateur n\'est pas enregistré',
                ], 401);
            } else {
                $user = User::where('email', $request->email)->first();

                return response()->json([
                    'status' => true,
                    'message' => 'utilisateur connecté avec succès',
                    'token' => $user->createToken('api token')->plainTextToken,
                ], 200);
            }
        } catch (\Throwable $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function view($id)
    {
        $patient = User::findOrFail($id);
        $prescriptions = Prescription::where('user_id', $id)->orderBy('id', 'desc')->get();
        $appointments = Appointment::where('user_id', $id)->orderBy('id', 'desc')->get();
        $tests = Test::where('user_id', $id)->orderBy('id', 'desc')->get();
        $documents = Document::where('user_id', $id)->orderBy('id', 'desc')->get();
        $invoices = Billing::where('user_id', $id)->orderBy('id', 'desc')->get();
        $historys = History::where('user_id', $id)->orderBy('id', 'desc')->get();

        return response()->json([
            'patient' => $patient,
            'prescriptions' => $prescriptions,
            'appointments' => $appointments,
            'invoices' => $invoices,
            'documents' => $documents,
            'historys' => $historys,
            'tests' => $tests,
        ]);
    }

    public function updateUser(Request $request, User $user)
    {
        try {
            $user = User::findOrFail($user->id);

            $validatedData = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'password' => ['required', 'string'],
                'role_id' => ['numeric'],
                // Ajoutez ici les règles de validation supplémentaires pour les autres champs du patient
            ]);

            if ($validatedData->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vous avez oublié un champ',
                    'error' => $validatedData->errors(),
                ], 401);
            } else {
                $user->password = \Hash::make($request->password);
                $user->email = $request->email;
                $user->name = $request->name;
                $user->role_id = $request->role_id ?? 3;
                $user->update();

                $patient = Patient::where('user_id', $user->id)->first();
                if ($patient) {
                    if ($request->has('phone')) {
                        $patient->phone = $request->phone;
                    }
                    if ($request->has('gender')) {
                        $patient->gender = $request->gender;
                    }
                    if ($request->has('birthday')) {
                        $patient->birthday = $request->birthday;
                    }
                    if ($request->has('adress')) {
                        $patient->adress = $request->adress;
                    }
                    $patient->update();
                }

                $role = Role::findById($user->role_id);

                if ($role) {
                    $user->assignRole($role);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Le rôle ID spécifié n\'existe pas',
                    ], 404);
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Utilisateur modifié avec succès',
                ], 200);
            }
        } catch (\Throwable $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function LogoutUser(Request $request)
    {
        if ($request->user()->currentAccessToken()->delete()) {
            return response()->json(['success' => true, 'message' => 'Utilisateur deconnecté avec succès'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
    }

    public function CreateTest(Request $request)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'test_name' => 'required',
                'diagnostic_type' => ['required', 'array', Rule::in(['DIAGNOSE PEAU', 'DIAGNOSE MAIN', 'DIAGNOSE PIED'])],
                // Skin diagnostic section validation rules
                // 'sebum_grp' => ['required_if:diagnostic_type,DIAGNOSE PEAU', 'array', Rule::in(['Léger', 'Normale', 'Grasse', 'Acnéique'])],
                // 'hydratation_grp' => ['required_if:diagnostic_type,DIAGNOSE PEAU', 'array', Rule::in(['Léger', 'Normale', 'Sèche', 'Tiraillement'])],
                // 'keratinisation_grp' => ['required_if:diagnostic_type,DIAGNOSE PEAU', 'array', Rule::in(['Léger', 'Normale', 'Sèche', 'Desquamée', 'Gerssures'])],
                // 'follicule_grp' => ['required_if:diagnostic_type,DIAGNOSE PEAU', 'array', Rule::in(['Léger', 'Normale', 'Faible', 'Sèche', 'Desquamée'])],
                // 'relief_grp' => ['required_if:diagnostic_type,DIAGNOSE PEAU', 'array', Rule::in(['Léger', 'Normale', 'Fin', 'Serré', 'Pores dilatés', 'Pores obstrués'])],
                // 'elasticite_grp' => ['required_if:diagnostic_type,DIAGNOSE PEAU', 'array', Rule::in(['Léger', 'Normale', 'Faible', 'Bonne'])],
                // 'sensibilite_grp' => ['required_if:diagnostic_type,DIAGNOSE PEAU', 'array', Rule::in(['Léger', 'Normale', 'Sensible', 'Réactive', 'Hypersensibilité'])],
                // 'circulation_grp' => ['required_if:diagnostic_type,DIAGNOSE PEAU', 'array', Rule::in(['Régulière', 'Irrégulière', 'Plaques'])],
                'signes_particuliers_peau' => ['required_if:diagnostic_type,DIAGNOSE PEAU', 'array', Rule::in(['Points noirs', 'Rosacée', 'Rousseurs', 'Télangiectasie', 'Pustules', 'Hypertrichose', 'Pigmentations', 'Vitiligo', 'Cicatrice', 'Chéloïdes', 'Comédons'])],
                // hand diagnostic section validation rules
                'Etat_generale_des_mains' => ['required_if:diagnostic_type,DIAGNOSE MAIN', Rule::in(['Normale', 'Sèche', 'Très sèches', 'Atrophiées'])],
                'Etat_des_ongles_mains' => ['required_if:diagnostic_type,DIAGNOSE MAIN', Rule::in(['Normaux', 'Dures', 'Cassants', 'Fragiles'])],
                'signes_particuliers_mains' => ['required_if:diagnostic_type,DIAGNOSE MAIN', 'array', Rule::in(['Rousseurs', 'Pigmentation', 'Desquamations', 'Cicatrices'])],
                'signes_particuliers_ongles_mains' => ['required_if:diagnostic_type,DIAGNOSE MAIN', 'array', Rule::in(['Epais', 'Décollés', 'Colorés', 'Petites taches', 'Fripés', 'Friables et poudreux', 'Striées'])],
                'soinList_main' => ['required_if:diagnostic_type,DIAGNOSE MAIN', 'array', Rule::in(['1', '2', '3'])],
                'reliefInput_main' => 'required_if:diagnostic_type,DIAGNOSE MAIN',
                'cicatrices_main' => ['required_if:diagnostic_type,DIAGNOSE MAIN', Rule::in(['oui', 'non'])],
                'callosites_main' => ['required_if:diagnostic_type,DIAGNOSE MAIN', Rule::in(['oui', 'non'])],
                'spInput_main' => 'required_if:diagnostic_type,DIAGNOSE MAIN',
                'skinStateInput_main' => 'required_if:diagnostic_type,DIAGNOSE MAIN',
                'tache_main' => 'required_if:diagnostic_type,DIAGNOSE MAIN',
                'cicatrices_main_dorsal' => ['required_if:diagnostic_type,DIAGNOSE MAIN', Rule::in(['oui', 'non'])],
                'callosite_main_dorsal' => ['required_if:diagnostic_type,DIAGNOSE MAIN', Rule::in(['oui', 'non'])],
                'spInput_main_dorsal' => 'required_if:diagnostic_type,DIAGNOSE MAIN',
                // foot diagnostic section validation rules
                'Etat_generale_des_pieds' => ['required_if:diagnostic_type,DIAGNOSE PIED', Rule::in(['Normale', 'Sèche', 'Très sèches', 'Atrophiées'])],
                'Etat_des_ongles_pieds' => ['required_if:diagnostic_type,DIAGNOSE PIED', Rule::in(['Normaux', 'Dures', 'Cassants', 'Fragiles'])],
                'signes_particuliers_pieds' => ['required_if:diagnostic_type,DIAGNOSE PIED', 'array', Rule::in(['Rousseurs', 'Pigmentation', 'Desquamations', 'Cicatrices'])],
                'signes_particuliers_ongles_pieds' => ['required_if:diagnostic_type,DIAGNOSE PIED', 'array', Rule::in(['Epais', 'Décollés', 'Colorés', 'Petites taches', 'Fripés', 'Friables et poudreux', 'Striées'])],
                'soinList_pied' => ['required_if:diagnostic_type,DIAGNOSE PIED', 'array', Rule::in(['1', '2', '3'])],
                'etat_pieds' => 'required_if:diagnostic_type,DIAGNOSE PIED',
                'taches_pieds' => ['required_if:diagnostic_type,DIAGNOSE PIED', Rule::in(['oui', 'non'])],
                'aureoles_pieds' => ['required_if:diagnostic_type,DIAGNOSE PIED', Rule::in(['oui', 'non'])],
                'veines_face_ext_pieds' => ['required_if:diagnostic_type,DIAGNOSE PIED', Rule::in(['oui', 'non'])],
                'veines_face_int_pieds' => ['required_if:diagnostic_type,DIAGNOSE PIED', Rule::in(['oui', 'non'])],
                'douleur_talon_pieds' => ['required_if:diagnostic_type,DIAGNOSE PIED', Rule::in(['oui', 'non'])],
                'spInput_pieds' => 'required_if:diagnostic_type,DIAGNOSE PIED',
            ]);
            if ($validatedData->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'un champ a été oublié',
                    'errors' => $validatedData->errors(),
                ], 400);
            } else {
                $test = new Test();

                $test->user_id = $request->patient_id;
                $test->test_name = $request->test_name;
                $test->comment = $request->comment;
                $test->created_by = Auth::user()->id;
                $test->diagnostic_type = json_encode($request->diagnostic_type);

                // skin diagnostic
                $test->sebum_grp = json_encode($request->sebum_grp);
                $test->hydratation_grp = json_encode($request->hydratation_grp);
                $test->keratinisation_grp = json_encode($request->keratinisation_grp);
                $test->follicule_grp = json_encode($request->follicule_grp);
                $test->relief_grp = json_encode($request->relief_grp);
                $test->elasticite_grp = json_encode($request->elasticite_grp);
                $test->sensibilite_grp = json_encode($request->sensibilite_grp);
                $test->circulation_grp = json_encode($request->circulation_grp);
                $test->signes_particuliers_peau = json_encode($request->signes_particuliers_peau);
                // hand diagnostic
                $test->Etat_generale_des_mains = $request->Etat_generale_des_mains;
                $test->Etat_des_ongles_mains = $request->Etat_des_ongles_mains;
                $test->signes_particuliers_mains = json_encode($request->signes_particuliers_mains);
                $test->signes_particuliers_ongles_mains = json_encode($request->signes_particuliers_ongles_mains);
                $test->soinList_main = json_encode($request->soinList_main);
                $test->vernisInput_main = $request->vernisInput_main;
                // $test->obserationInput_main = $request->obserationInput_main;
                $test->reliefInput_main = $request->reliefInput_main;
                $test->cicatrices_main = $request->cicatrices_main;
                $test->callosites_main = $request->callosites_main;
                $test->spInput_main = $request->spInput_main;
                $test->skinStateInput_main = $request->skinStateInput_main;
                $test->tache_main = $request->tache_main;
                $test->cicatrices_main_dorsal = $request->cicatrices_main_dorsal;
                $test->callosite_main_dorsal = $request->callosite_main_dorsal;
                $test->spInput_main_dorsal = $request->spInput_main_dorsal;
                // foot diagnostic

                $test->Etat_generale_des_pieds = $request->Etat_generale_des_pieds;
                $test->Etat_des_ongles_pieds = $request->Etat_des_ongles_pieds;
                $test->signes_particuliers_pieds = json_encode($request->signes_particuliers_pieds);
                $test->signes_particuliers_ongles_pieds = json_encode($request->signes_particuliers_pieds);
                $test->soinList_pied = json_encode($request->soinList_pied);
                $test->vernisInput_pied = $request->vernisInput_pied;
                // $test->obserationInput_pied = $request->obserationInput_pied;
                $test->etat_pieds = $request->etat_pieds;
                $test->taches_pieds = $request->taches_pieds;
                $test->aureoles_pieds = $request->aureoles_pieds;
                $test->veines_face_ext_pieds = $request->veines_face_ext_pieds;
                $test->veines_face_int_pieds = $request->veines_face_int_pieds;
                $test->douleur_talon_pieds = $request->douleur_talon_pieds;
                $test->spInput_pieds = $request->spInput_pieds;

                $test->save();

                return response()->json([
                    'status' => true,
                    'message' => 'votre diagnostic a été enregistré avec succès',
                    'test' => $test
                ]);
            }
        } catch (Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'une erreur est survenue',
                'error' => $ex->getMessage()
            ]);
        }
    }
}
