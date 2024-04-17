<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Billing;
use App\Document;
use App\History;
use App\Patient;
use App\Prescription;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all()
    {
        $sortColumn = request()->get('sort');
        $sortOrder = request()->get('order', 'asc');
        if (!empty($sortColumn)) {
            $patients = User::where('role_id', '3')->OrderBy($sortColumn, $sortOrder)->paginate(25);
        } else {
            $patients = User::where('role_id', '3')->paginate(25);
        }

        return view('patient.all', ['patients' => $patients]);
    }

    public function create()
    {
        return view('patient.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'birthday' => ['required', 'before:today'],
            'gender' => ['required',
                        Rule::in(['Homme', 'Femme']),
                        ],
            'morphology' => ['required', 'array', Rule::in(['Aucune', 'Grand(e)', 'Svelte', 'Petit(e)', 'Mince', 'Maigre', 'Rondeur', 'Enveloppé(e)'])],

            'alimentation' => ['required', 'array',
                Rule::in(['Aucune', 'Viande', 'Poisson', 'Légumes', 'Céréales', 'Tubercules', 'Fruits', 'Alcool', "Pas d'alcool", 'Fumeur', 'Non-fumeur'])],

            'type_patient' => ['required', 'array', Rule::in(['Aucun', 'Elancé(e)', 'Mince', 'Amazone', 'Forte'])],

            'digestion' => 'required',

            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        $user = new User();
        $user->password = \Hash::make('admin');
        $user->email = $request->email;
        $user->name = $request->name;

        if ($request->hasFile('image')) {
            // We Get the image
            $file = $request->file('image');
            // We Add String to Image name
            $fileName = \Str::random(15).'-'.$file->getClientOriginalName();
            // We Tell him the uploads path
            $destinationPath = public_path().'/uploads/';
            // We move the image to the destination path
            $file->move($destinationPath, $fileName);
            // Add fileName to database

            $user->image = $fileName;
        } else {
            $user->image = '';
        }

        $user->save();

        $patient = new Patient();

        $patient->user_id = $user->id;
        $patient->birthday = $request->birthday;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        $patient->adress = $request->adress;
        $patient->allergie = $request->allergie;
        $patient->medication = $request->medication;
        $patient->hobbie = $request->hobbie;
        $patient->demande = $request->demande;
        $patient->type_patient = json_encode($request->type_patient);
        $patient->morphology = json_encode($request->morphology);
        $patient->alimentation = json_encode($request->alimentation);
        $patient->digestion = $request->digestion;
        $patient->save();

        return \Redirect::route('patient.all')->with('success', __('sentence.Patient Created Successfully'));
    }

    public function edit($id)
    {
        $patient = User::findOrfail($id);
        $user = User::findOrfail($id);

        return view('patient.edit', ['patient' => $patient, 'user' => $user]);
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users')->ignore($request->user_id),
        ],
        'birthday' => ['required', 'before:today'],

        'gender' => ['required',
                    Rule::in(['Homme', 'Femme']),
                    ],

        'morphology' => ['required', 'array', Rule::in(['Aucune', 'Grand(e)', 'Svelte', 'Petit(e)', 'Mince', 'Maigre', 'Rondeur', 'Enveloppé(e)'])],

        'alimentation' => ['required', 'array',
                 Rule::in(['Aucune', 'Viande', 'Poisson', 'Légumes', 'Céréales', 'Tubercules', 'Fruits', 'Alcool', "Pas d'alcool", 'Fumeur', 'Non-fumeur'])],

           'type_patient' => ['required', 'array', Rule::in(['Aucun', 'Elancé(e)', 'Mince', 'Amazone', 'Forte'])],

           'digestion' => 'required',

           'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        $user = User::find($request->user_id);

        $user->email = $request->email;
        $user->name = $request->name;

        if ($request->hasFile('image')) {
            // We Get the image
            $file = $request->file('image');
            // We Add String to Image name
            $fileName = \Str::random(15).'-'.$file->getClientOriginalName();
            // We Tell him the uploads path
            $destinationPath = public_path().'/uploads/';
            // We move the image to the destination path
            $moved = $file->move($destinationPath, $fileName);
            // Add fileName to database

            $fullpath = public_path().'/uploads/'.$user->image;

            if ($moved && !empty($user->image)) {
                unlink($fullpath);
            }

            $user->image = $fileName;
        }

        $user->update();

        $patient = Patient::where('user_id', '=', $request->user_id)
                             ->update(['birthday' => $request->birthday,
                                        'phone' => $request->phone,
                                        'gender' => $request->gender,
                                        'adress' => $request->adress,
                                        'allergie' => $request->allergie,
                                        'medication' => $request->medication,
                                        'hobbie' => $request->hobbie,
                                        'demande' => $request->demande,
                                        'type_patient' => json_encode($request->type_patient),
                                        'morphology' => json_encode($request->morphology),
                                        'alimentation' => json_encode($request->alimentation),
                                        'digestion' => $request->digestion,
                                        ]);

        return \Redirect::back()->with('success', __('sentence.Patient Updated Successfully'));
    }

    public function view($id)
    {
        $patient = User::findOrfail($id);
        $prescriptions = Prescription::where('user_id', $id)->OrderBy('id', 'Desc')->get();
        $appointments = Appointment::where('user_id', $id)->OrderBy('id', 'Desc')->get();
        $tests = Test::where('user_id', $id)->OrderBy('id', 'Desc')->get();
        $documents = Document::where('user_id', $id)->OrderBy('id', 'Desc')->get();
        $invoices = Billing::where('user_id', $id)->OrderBy('id', 'Desc')->get();
        $historys = History::where('user_id', $id)->OrderBy('id', 'Desc')->get();

        return view('patient.view', [
            'patient' => $patient,
            'prescriptions' => $prescriptions,
            'appointments' => $appointments,
            'invoices' => $invoices,
            'documents' => $documents,
            'historys' => $historys,
            'tests' => $tests,
        ]);
    }

    public function search(Request $request)
    {
        $term = $request->term;

        $patients = User::where('name', 'LIKE', '%'.$term.'%')->OrderBy('id', 'DESC')->paginate(25);

        return view('patient.all', ['patients' => $patients]);
    }

    public function destroy($id)
    {
        $patient = User::destroy($id);

        return \Redirect::back()->with('success', 'Patient Deleted Successfully');
    }

    public function SendPassword($id)
    {
        $user = User::find($id);

        $newPassword = rand(10000000, 99999999);

        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        // Envoie de la notification par e-mail
        $user->notify(new ResetPasswordNotification($newPassword));

        return back()->with('success', 'Password Sent Successfully');
    }
}
