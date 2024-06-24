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
use Illuminate\Support\Facades\Http;

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
            $patients = User::where('role_id', '3')->OrderBy($sortColumn, $sortOrder)->paginate(10);
        } else {
            $patients = User::where('role_id', '3')->paginate(10);
        }

        return view('patient.all', ['patients' => $patients]);
    }

    public function create()
    {
        return view('patient.create');
    }

    public function generateToken($user)
    {
        $payload = [
            'sub' => $user->email,
            'permissions' => ['createProduct',
            'viewProduct',
            'updateProduct',
            'deleteProduct',
            'createCustomer',
            'viewCustomer',
            'updateCustomer',
            'deleteCustomer',
            'createSupplier',
            'viewSupplier',
            'updateSupplier',
            'deleteSupplier',
            'createTransaction',
            'viewTransaction',
            'updateTransaction',
            'deleteTransaction',
            'createSaleInvoice',
            'viewSaleInvoice',
            'updateSaleInvoice',
            'deleteSaleInvoice',
            'createPurchaseInvoice',
            'viewPurchaseInvoice',
            'updatePurchaseInvoice',
            'deletePurchaseInvoice',
            'createPaymentPurchaseInvoice',
            'viewPaymentPurchaseInvoice',
            'updatePaymentPurchaseInvoice',
            'deletePaymentPurchaseInvoice',
            'createPaymentSaleInvoice',
            'viewPaymentSaleInvoice',
            'updatePaymentSaleInvoice',
            'deletePaymentSaleInvoice',
            'createRole',
            'viewRole',
            'updateRole',
            'deleteRole',
            'createRolePermission',
            'viewRolePermission',
            'updateRolePermission',
            'deleteRolePermission',
            'createUser',
            'viewUser',
            'updateUser',
            'deleteUser',
            'professionalUser',
            'viewDashboard',
            'viewPermission',
            'createDesignation',
            'viewDesignation',
            'updateDesignation',
            'deleteDesignation',
            'createProductCategory',
            'viewProductCategory',
            'updateProductCategory',
            'deleteProductCategory',
            'createReturnPurchaseInvoice',
            'viewReturnPurchaseInvoice',
            'updateReturnPurchaseInvoice',
            'deleteReturnPurchaseInvoice',
            'createReturnSaleInvoice',
            'viewReturnSaleInvoice',
            'updateReturnSaleInvoice',
            'deleteReturnSaleInvoice',
            'updateSetting',
            'viewSetting'], // Ajoutez les permissions ici
            'iat' => time(),
            'exp' => time() + 60 * 60 * 24, // 24 heures
        ];

        $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

        return $jwt; // Retourne le JWT sans l'envelopper dans une réponse JSON
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'birthday' => ['required', 'before:today'],
            'gender' => [
                'required',
                Rule::in(['Homme', 'Femme']),
            ],
            'morphology' => ['required', 'array', Rule::in(['Aucune', 'Grand(e)', 'Svelte', 'Petit(e)', 'Mince', 'Maigre', 'Rondeur', 'Enveloppé(e)'])],

            'alimentation' => [
                'required', 'array',
                Rule::in(['Aucune', 'Viande', 'Poisson', 'Légumes', 'Céréales', 'Tubercules', 'Fruits', 'Alcool', "Pas d'alcool", 'Fumeur', 'Non-fumeur'])
            ],

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
            $fileName = \Str::random(15) . '-' . $file->getClientOriginalName();
            // We Tell him the uploads path
            $destinationPath = public_path() . '/uploads/';
            // We move the image to the destination path
            $file->move($destinationPath, $fileName);
            // Add fileName to database

            $user->image = $fileName;
        } else {
            $user->image = '';
        }
        $user->role_id = 3;

        $role = Role::findById(3);

        // If the role exists, assign it to the user
        if ($role) {
            $user->assignRole($role);
        } else {
            return \Redirect::route('patient.all')->with('error', __('sentence.role id does not exist'));
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

        // Générer le token JWT
        $token = $this->generateToken($user);

        $response = Http::withToken($token)->post('http://localhost:5001/v1/customer/', [
            'name' => $user->name,
            'phone' => $request->phone,
            'address' => $request->adress,
            'type_customer' => 'particulier',
            'createdAt' => $user->created_at->format('Y-m-d\TH:i:s.u\Z'),
            'updatedAt' => $user->updated_at->format('Y-m-d\TH:i:s.u\Z'),
        ]);

        return \Redirect::route('test.create_by', ['id' => $patient->user_id])->with('success', __('sentence.Patient Created Successfully'));
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

            'gender' => [
                'required',
                Rule::in(['Homme', 'Femme']),
            ],

            'morphology' => ['required', 'array', Rule::in(['Aucune', 'Grand(e)', 'Svelte', 'Petit(e)', 'Mince', 'Maigre', 'Rondeur', 'Enveloppé(e)'])],

            'alimentation' => [
                'required', 'array',
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

        $appointIds = Appointment::whereHas('rdv__drugs')
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

        $patients = User::where('name', 'LIKE', '%' . $term . '%')->OrderBy('id', 'DESC')->paginate(25);

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
            'password' => \Hash::make($newPassword),
        ]);

        // Envoie de la notification par e-mail
        $user->notify(new ResetPasswordNotification($newPassword));

        return back()->with('success', 'Password Sent Successfully');
    }
}
