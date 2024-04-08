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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Throwable;

class UserApiController extends Controller
{
    //

    public function RegisterUser(Request $request)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string'],
                'role_id' => ['numeric'],
            ]);

            if ($validatedData->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vous avez oublié un champ',
                    'érreurs' => $validatedData->errors(),
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
                    'token' => $user->createToken("api token")->plainTextToken
                ], 200);
            }
        } catch (Throwable $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function LoginUser(Request $request){
        try{
            $validatedData = Validator::make($request->all(), [
                'email' => ['required','email'],
                'password' => 'required'
            ]);
            if ($validatedData->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de Validation',
                    'érreurs' => $validatedData->errors(),
                ], 401);
            }

            if(!Auth::attempt($request->only(['email','password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'cet utilisateur n\'est pas enregistré',
                ],401);
            } else{
                $user = User::where('email', $request->email)->first();
                return response()->json([
                    'status'=>true,
                    'message' => 'utilisateur connecté avec succès',
                    'token' => $user->createToken("api token")->plainTextToken
                ], 200);
            }
        }
        catch(Throwable $ex){
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
                    'érreurs' => $validatedData->errors(),
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
                    'message' => 'Utilisateur modifié avec succès'
                    // 'token' => $user->createToken("api token")->plainTextToken
                ], 200);
            }
        } catch (Throwable $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }
}
