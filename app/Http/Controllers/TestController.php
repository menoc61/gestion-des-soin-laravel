<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('test.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'test_name' => 'required',
            'diagnostic_type' => ['required', 'array', Rule::in(['DIAGNOSE PEAU', 'DIAGNOSE MAIN', 'DIAGNOSE PIED'])],
          // Skin diagnostic section validation rules
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

        $test->test_name = $request->test_name;
        $test->comment = $request->comment;
        $test->diagnostic_type = json_encode($request->diagnostic_type);

        // skin diagnostic
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

        return \Redirect::route('test.all')->with('success', __('sentence.Test Created Successfully'));
    }

    public function all()
    {
        $tests = Test::all();

        return view('test.all', ['tests' => $tests]);
    }

    public function edit($id)
    {
        $test = Test::find($id);

        return view('test.edit', ['test' => $test]);
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'test_name' => 'required',
            'diagnostic_type' => ['required', 'array', Rule::in(['DIAGNOSE PEAU', 'DIAGNOSE MAIN', 'DIAGNOSE PIED'])],
          // Skin diagnostic section validation rules
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

        $test->test_name = $request->test_name;
        $test->comment = $request->comment;
        $test->diagnostic_type = json_encode($request->diagnostic_type);

        // skin diagnostic
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

        return \Redirect::route('test.all')->with('success', __('sentence.Test Edited Successfully'));
    }

    public function destroy($id)
    {
        Test::destroy($id);

        return \Redirect::route('test.all')->with('success', __('sentence.Test Deleted Successfully'));
    }
}
