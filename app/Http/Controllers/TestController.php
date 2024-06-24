<?php

namespace App\Http\Controllers;

use App\Test;
use App\User;
use App\Prescription_test;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $patients = User::where('role_id', '3')->get();
        return view('test.create', compact('patients'));
    }

    public function create_By_id($id)
    {
        $user = User::find($id);
        // Vérifiez si l'utilisateur existe
        if (!$user) {
            // Gérez le cas où l'utilisateur n'est pas trouvé
        }
        return view('test.create_by_user', ['userId' => $id, 'userName' => $user->name]);
    }

    public function create_Psychotherapie_By_Id($id)
    {
        $user = User::find($id);
        // Vérifiez si l'utilisateur existe
        if (!$user) {
            // Gérez le cas où l'utilisateur n'est pas trouvé
        }
        return view('test.psychoterapie', ['userId' => $id, 'userName' => $user->name]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'test_name' => 'required',
            'diagnostic_type' => ['required', 'array', Rule::in(['DIAGNOSE PEAU', 'DIAGNOSE MAIN', 'DIAGNOSE PIED', 'PSYCHOTHERAPIE'])],
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

        if (Auth::user()->role_id == 3) {
            return back()->with('success', 'Votre Diagnose a été enregistré');
        } elseif (is_array($request->diagnostic_type) && in_array('PSYCHOTHERAPIE', $request->diagnostic_type)) {
            return \Redirect::route('prescription.psycho_by', ['id' => $test->user_id])->with('success', __('sentence.Test Created Successfully'));
        } else {
            return \Redirect::route('prescription.create_by', ['id' => $test->user_id])->with('success', __('sentence.Test Created Successfully'));
        }
    }

    public function all()
    {
        $user = Auth::user();
        $tests = Test::orWhereJsonDoesntContain('diagnostic_type', 'PSYCHOTHERAPIE')->get();

        // $sortColumn = request()->get('sort');
        // $sortOrder = request()->get('order', 'asc');
        // if (!empty($sortColumn)) {
        //     $tests = Test::orderBy($sortColumn, $sortOrder)->paginate(25);
        // }
        // //cette condition nous permettra d'afficher tous les tests si l'utilisateur a le role d'admin
        // if ($user->role_id != 1) {
        //     $tests = Test::where('created_by', $user->id)->get();
        // }
        // //cette condition nous permettra d'afficher pour un utilisateur connecté tous les tests qu'il a eu à créer et ce dernier doit avoir le role de praticien
        // else {
        //     $tests = Test::all();
        // }
        return view('test.all', ['tests' => $tests]);
    }

    public function edit($id)
    {
        $test = Test::find($id);
        $patients = User::where('role_id', '3')->get();
        return view('test.edit', compact('patients', 'test'));
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'test_name' => 'required',
            // 'diagnostic_type' => ['', 'array', Rule::in(['DIAGNOSE PEAU', 'DIAGNOSE MAIN', 'DIAGNOSE PIED'])],
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

        $test = Test::find($request->test_id);
        // dd($test);
        if ($test) {
            $test->test_name = $request->test_name;
            $test->comment = $request->comment;
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

            $test->update();
            return \Redirect::route('test.all')->with('success', __('sentence.Test Edited Successfully'));
        } else {
            // Gérer le cas où le médicament n'est pas trouvé
            return \Redirect::route('test.all')->with('error', __('sentence.Test Not Found'));
        }
    }

    public function destroy($id)
    {
        Test::destroy($id);

        return \Redirect::back()->with('success', __('sentence.Test Deleted Successfully'));
    }

    public function view_diagnostic($id)
    {
        $User = User::findOrfail($id);

        $tests = Test::where('user_id', $id)->paginate(25);

        return view('test.view_diagnostic', ['tests' => $tests]);
    }

    // public function view_test($id)
    // {
    //     $prescription_tests = Prescription_test::where('prescription_id', $id)->get();
    //     return view('test.view_test', ['prescription_tests' => $prescription_tests]);
    // }

    public function view_test($id)
    {
        $tests = Test::where('id', $id)->get();
        return view('test.view_test', ['tests' => $tests]);
    }
}
