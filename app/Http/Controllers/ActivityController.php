<?php

namespace App\Http\Controllers;

use App\ActivityReport;
use App\Drug;
use App\User;
use App\Rdv_Drug;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function all(Request $request)
    {
        // Vérifier le rôle de l'utilisateur connecté
        //$user = \Auth::user();
        if (Auth::user()->role_id == 2) {
            // Si l'utilisateur est un docteur (role_id=2), ne récupérer que ses rapports
            $activity_report = ActivityReport::where('doctor_id', Auth::user()->id)->get();
        } else {
            // Si l'utilisateur est un administrateur (role_id=1), récupérer tous les rapports
            $activity_report = ActivityReport::all();
        }
    
        // Passer les rapports filtrés à la vue
        return view('report.all', compact('activity_report'));
    }
    

    public function create()
    {
       // $users = User::all();
        $praticiens = User::where('role_id', '!=', 3)->get();
        $patients = User::where('role_id', '3')->get();
        $drugs = Drug::all();


        //return view('appointment.create', ['users' => $users,'patients' => $patients, 'praticiens' => $praticiens, 'drugs' => $drugs,]);
        return view('report.create', ['praticiens' => $praticiens, 'patients' => $patients, 'drugs' => $drugs,]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'doctor_id' => ['required', 'exists:users,id'],
            'patient' => ['required', 'exists:users,id'],
            'drug_id' => 'required|array|min:1',
            'drug_id.*' => 'exists:drugs,id',
            'amountDrug' => 'required|array|min:1',
            'amountDrug.*' => 'numeric|min:0',
            'observation' => 'required',
            'next_rdv' => 'required|date',
            'pourboire' => 'required|numeric',
            
        ]);

    
        $activityReport = new ActivityReport();
        $activityReport->doctor_id = $request->doctor_id;
        $activityReport->user_id = $request->patient;
        $activityReport->observation = $request->observation;
        $activityReport->next_rdv = $request->next_rdv;
        $activityReport->pourboire = $request->pourboire;
        $activityReport->save();
        // $activityReport = ActivityReport::create([
        //     'doctor_id' => $request->doctor_id,
        //     'patient' => $request->patient,
        //     'user_id' =>  Auth::id(),
        //     'observation' => $request->observation,
        //     'next_rdv' => $request->next_rdv,
        //     'pourboire' => $request->pourboire,
        // ]);
    
        $drugsData = [];
        foreach ($request->drug_id as $index => $drugId) {
            $drugsData[$drugId] = ['amountDrug' => $request->amountDrug[$index]];
        }
    
        $activityReport->drugs()->attach($drugsData);
        

        return redirect()->route('report.all')->with('success', 'Rapport ajouté avec succès.');
    }

    public function show(ActivityReport $activityReport)
    {
        return view('report.show', compact('activityReport'));
    }

    

    public function edit(ActivityReport $activityReport)
    {
        $users = User::all();
        $drugs = Drug::all();
        $selectedDrugs = $activityReport->drugs()->pluck('drug_id')->toArray();

        return view('report.edit', compact('activityReport', 'users', 'drugs'));
    }

    public function update(Request $request, ActivityReport $activityReport)
    {
        $request->validate([
            'doctor_id' => ['required', 'exists:users,id'],
            'patient' => ['required', 'exists:users,id'],
            'user_id' => 'required|exists:users,id',
            'drug_id' => 'required|array|min:1',
            'drug_id.*' => 'exists:drugs,id',
            'amountDrug' => 'required|array|min:1',
            'amountDrug.*' => 'numeric|min:0',
            'observation' => 'required',
            'next_rdv' => 'required|date',
            'pourboire' => 'required|numeric',
            
        ]);

        $activityReport->update([
            'user_id' => $request->patient,
            'doctor_id' => $request->doctor_id,
            'observation' => $request->observation,
            'next_rdv' => $request->next_rdv,
            'pourboire' => $request->pourboire,
            
        ]);
    
        $drugsData = [];
        foreach ($request->drug_id as $index => $drugId) {
            $drugsData[$drugId] = ['amountDrug' => $request->amountDrug[$index]];
        }
    
        $activityReport->drugs()->sync($drugsData);

        return redirect()->route('report.edit')->with('success', 'Rapport mis à jour.');
    }

    public function print($id)
    {
    $activityReport = ActivityReport::with('doctor', 'drugs', 'user')->findOrFail($id);
    
    return view('report.print', compact('activityReport'));
    }


    public function destroy($id)
    {
        $activityReport = ActivityReport::destroy($id);
        return redirect()->route('report.all')->with('success', 'Rapport supprimé.');
    }

    // = ActivityReportpublic function destroy($id)
    // public function destroy($id)
    // {
    //     $user = User::destroy($id);

    //     return \Redirect::back()->with('success', 'Utilisateur Supprimé Avec Succès');
    // }
}
