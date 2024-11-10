<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Billing;
use App\Document;
use App\Drug;
use App\History;
use App\Notifications\ResetPasswordNotification;
use App\Patient;
use App\Payment;
use App\Prescription;
use App\Rdv_Drug;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('store', 'createnew');
    }

    public function all()
    {
        $sortColumn = request()->get('sort');
        $sortOrder = request()->get('order', 'asc');
        if (!empty($sortColumn)) {
            $patients = User::where('role_id', '3')->OrderBy($sortColumn, $sortOrder)->paginate(7);
        } else {
            $patients = User::where('role_id', '3')->paginate(7);
        }

        return view('patient.all', ['patients' => $patients]);
    }

    public function create()
    {
        return view('patient.create');
    }

    public function createnew()
    {
        return view('auth.register');
    }

    // public function generateToken($user)
    // {
    //     $payload = [
    //         'sub' => $user->email,
    //         'permissions' => [
    //             'createProduct',
    //             'viewProduct',
    //             'updateProduct',
    //             'deleteProduct',
    //             'createCustomer',
    //             'viewCustomer',
    //             'updateCustomer',
    //             'deleteCustomer',
    //             'createSupplier',
    //             'viewSupplier',
    //             'updateSupplier',
    //             'deleteSupplier',
    //             'createTransaction',
    //             'viewTransaction',
    //             'updateTransaction',
    //             'deleteTransaction',
    //             'createSaleInvoice',
    //             'viewSaleInvoice',
    //             'updateSaleInvoice',
    //             'deleteSaleInvoice',
    //             'createPurchaseInvoice',
    //             'viewPurchaseInvoice',
    //             'updatePurchaseInvoice',
    //             'deletePurchaseInvoice',
    //             'createPaymentPurchaseInvoice',
    //             'viewPaymentPurchaseInvoice',
    //             'updatePaymentPurchaseInvoice',
    //             'deletePaymentPurchaseInvoice',
    //             'createPaymentSaleInvoice',
    //             'viewPaymentSaleInvoice',
    //             'updatePaymentSaleInvoice',
    //             'deletePaymentSaleInvoice',
    //             'createRole',
    //             'viewRole',
    //             'updateRole',
    //             'deleteRole',
    //             'createRolePermission',
    //             'viewRolePermission',
    //             'updateRolePermission',
    //             'deleteRolePermission',
    //             'createUser',
    //             'viewUser',
    //             'updateUser',
    //             'deleteUser',
    //             'professionalUser',
    //             'viewDashboard',
    //             'viewPermission',
    //             'createDesignation',
    //             'viewDesignation',
    //             'updateDesignation',
    //             'deleteDesignation',
    //             'createProductCategory',
    //             'viewProductCategory',
    //             'updateProductCategory',
    //             'deleteProductCategory',
    //             'createReturnPurchaseInvoice',
    //             'viewReturnPurchaseInvoice',
    //             'updateReturnPurchaseInvoice',
    //             'deleteReturnPurchaseInvoice',
    //             'createReturnSaleInvoice',
    //             'viewReturnSaleInvoice',
    //             'updateReturnSaleInvoice',
    //             'deleteReturnSaleInvoice',
    //             'updateSetting',
    //             'viewSetting'
    //         ], // Ajoutez les permissions ici
    //         'iat' => time(),
    //         'exp' => time() + 60 * 60 * 24, // 24 heures
    //     ];

    //     $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

    //     return $jwt; // Retourne le JWT sans l'envelopper dans une réponse JSON
    // }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validation des données
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'gender' => ['required', 'string'],
            'phone' => ['required', 'unique:users,phone'],
        ]);

        $password = $request->password ?? 'admin'; // Assurez-vous de remplacer 'default_password' par un mot de passe sécurisé si nécessaire

        // Création de l'utilisateur
        $user = new User();
        $user->password = \Hash::make($password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->appChoice = $request->appChoice ?? 'false';
        $user->source = $request->source ?? 'Gestion de soins';

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = \Str::random(15) . '-' . $file->getClientOriginalName();
            $destinationPath = public_path('/uploads/');
            $file->move($destinationPath, $fileName);
            $user->image = $fileName;
        }

        // Assignation du rôle
        $user->role_id = $request->role_id ?? 3;
        $role = Role::findById(3);
        if ($role) {
            $user->assignRole($role);
        } else {
            return \Redirect::route('patient.all')->with('error', __('sentence.Role id does not exist'));
        }

        $user->save();

        // Synchronisation avec Node.js si la case est cochée
        if ($user->appChoice === 'true') {
            $response = Http::post('http://localhost:5001/v1/customer', [
                'email' => $user->email,
                'password' => $request->password,
                'role' => 'Particulier',
                'username' => $user->name,
                'phone' => $user->phone,
                'address' => $user->address,
                'gender' => $user->gender,
                'source' => $user->source,
                'createdAt' => $user->created_at->format('Y-m-d\TH:i:s.u\Z'),
                'updatedAt' => $user->updated_at->format('Y-m-d\TH:i:s.u\Z'),
            ]);

            if ($response->failed()) {
                return \Redirect::back()->with('error', __('sentence.User synchronization failed'));
            }
        }

        // Création du patient
        $patient = new Patient();
        $patient->user_id = $user->id;
        $patient->birthday = $request->birthday ?? '00-00-0000';
        $patient->allergie = $request->allergie ?? 'Aucune';
        $patient->medication = $request->medication ?? 'Aucune';
        $patient->hobbie = $request->hobbie ?? 'Aucun';
        $patient->demande = $request->demande ?? 'Aucune';
        $patient->type_patient = json_encode($request->type_patient ?? ['Aucun']);
        $patient->morphology = json_encode($request->morphology ?? ['Aucune']);
        $patient->alimentation = json_encode($request->alimentation ?? ['Aucune']);
        $patient->digestion = $request->digestion ?? 'Aucune';
        $patient->save();

        // Redirection selon le rôle de l'utilisateur
        if (auth()->user()) {
            return \Redirect::route('test.create_by', ['id' => $patient->user_id])->with('success', __('sentence.Patient Created Successfully'));
        } else {
            return \Redirect::route('login')->with('success', __('sentence.User Created Successfully'));
        }
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
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($request->user_id),
            ],
            
            'birthday' => ['required', 'before:today'],

            'gender' => [
                'required',
                Rule::in(['Homme', 'Femme']),
            ],

            'morphology' => ['required', 'array', Rule::in(['Aucune', 'Grand(e)', 'Svelte', 'Petit(e)', 'Mince', 'Maigre', 'Rondeur', 'Enveloppé(e)'])],

            'alimentation' => [
                'required',
                'array',
                Rule::in(['Aucune', 'Viande', 'Poisson', 'Légumes', 'Céréales', 'Tubercules', 'Fruits', 'Alcool', "Pas d'alcool", 'Fumeur', 'Non-fumeur'])
            ],

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
            $fileName = \Str::random(15) . '-' . $file->getClientOriginalName();
            // We Tell him the uploads path
            $destinationPath = public_path() . '/uploads/';
            // We move the image to the destination path
            $moved = $file->move($destinationPath, $fileName);
            // Add fileName to database

            $fullpath = public_path() . '/uploads/' . $user->image;

            if ($moved && !empty($user->image)) {
                unlink($fullpath);
            }

            $user->image = $fileName;
        }

        $user->update();

        $patient = Patient::where('user_id', '=', $request->user_id)
            ->update([
                'birthday' => $request->birthday,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
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
        $prescriptions = Prescription::select('prescriptions.*')
            ->join('prescription_tests', 'prescription_tests.prescription_id', '=', 'prescriptions.id')
            ->join('tests', 'tests.id', '=', 'prescription_tests.test_id')
            ->where('prescriptions.user_id', $id)
            ->where(function ($query) {
                $query->orWhereJsonDoesntContain('diagnostic_type', 'PSYCHOTHERAPIE');
            })->paginate(7);
        $psychos = Prescription::select('prescriptions.*')
            ->join('prescription_tests', 'prescription_tests.prescription_id', '=', 'prescriptions.id')
            ->join('tests', 'tests.id', '=', 'prescription_tests.test_id')
            ->where('prescriptions.user_id', $id)
            ->where(function ($query) {
                $query->whereJsonContains('diagnostic_type', 'PSYCHOTHERAPIE');
            })
            ->paginate(7);

        $appointments = Appointment::where('user_id', $id)->orderBy('id', 'desc')->paginate(7);

        $appointments->load('drugs'); // des rendez-vous

        $appointIds = Appointment::whereHas('rdv__drugs')->where('visited', 1)
            ->groupBy('id')
            ->pluck('id');

        $appointExist = Appointment::where('user_id', $id)
            ->whereIn('id', $appointIds)
            ->whereDoesntHave('Items')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $tests = Test::where('user_id', $id)
            ->where(function ($query) {
                $query->orWhereJsonDoesntContain('diagnostic_type', 'PSYCHOTHERAPIE');
            })
            ->orderBy('id', 'desc')
            ->paginate(7);

        $testpshychos = Test::where('user_id', $id)

            ->where(function ($query) {
                $query->whereJsonContains('diagnostic_type', 'PSYCHOTHERAPIE');
            })
            ->orderBy('id', 'desc')
            ->paginate(7);

        $documents = Document::where('user_id', $id)->OrderBy('id', 'Desc')->paginate(7);
        $invoices = Billing::where('user_id', $id)->OrderBy('id', 'Desc')->paginate(7);
        $historys = History::where('user_id', $id)->OrderBy('id', 'Desc')->paginate(7);

        return view('patient.view', [
            'patient' => $patient,
            'prescriptions' => $prescriptions,
            'appointments' => $appointments,
            'invoices' => $invoices,
            'documents' => $documents,
            'historys' => $historys,
            'tests' => $tests,
            'psychos' => $psychos,
            'testpshychos' => $testpshychos,
            'appointExist' => $appointExist,
        ]);
    }

    public function search(Request $request)
    {
        $term = $request->term;

        $patients = User::where('name', 'LIKE', '%' . $term . '%')->orWhere('email', 'LIKE', '%' . $term . '%')->OrderBy('id', 'DESC')->paginate(25);

        return view('patient.all', ['patients' => $patients]);
    }

    public function destroy($id)
    {
        $patient = User::destroy($id);

        return \Redirect::back()->with('success', 'Hôte Supprimé avec succès');
    }

    public function SendPassword($id)
    {
        $user = User::find($id);

        $newPassword = rand(10000000, 99999999);

        $user->update([
            'password' => \Hash::make($newPassword),
        ]);

        // Envoie de la notification par e-mail
        $user->notify(new ResetPasswordNotification($newPassword));

        return back()->with('success', 'Password Sent Successfully');
    }
}
