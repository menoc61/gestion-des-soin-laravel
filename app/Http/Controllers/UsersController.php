<?php

namespace App\Http\Controllers;

use App\Patient;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Redirect;
use Spatie\Permission\Models\Role;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Http;

class UsersController extends Controller
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
            $users = User::where('role_id','!=',3)->orderBy($sortColumn, $sortOrder)->paginate(25);
        } else {
            $users = User::where('role_id','!=',3)->paginate(25);
        }

        return view('user.all', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::all();

        return view('user.create', ['roles' => $roles]);
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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'numeric'],
            'fonction' => ['required', 'array', Rule::in([
                'Praticien Main',
                'Praticien Peau',
                'Praticien Pied',
                'Dermatologue',
            ])],
        ]);

        $user = new User();
        $user->password = \Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->fonction = json_encode($request->fonction);
        $role = Role::findById($request->role_id);
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
        // If the role exists, assign it to the user
        if ($role) {
            $user->assignRole($role);
        } else {
            return \Redirect::route('user.all')->with('error', __('sentence.role id does not exist'));
        }
        $user->save();

        if ($user->role_id == 1) {
            $role = 'admin';
        } else {
            $role = $role->name;
        }

        // Générer le token JWT
        $token = $this->generateToken($user);

        // Envoyer la requête avec le token
        $response = Http::withToken($token)->post('http://localhost:5001/v1/user/register', [
            'email' => $user->email,
            'password' => $request->password,
            'role' => $role,
            'username' => $user->name,
            'salary' => '5000',
            'designation_id' => 1,
            'join_date' => "2024-06-20 00:00:00",
            'leave_date' => "2024-06-20 00:00:00",
            'id_no' => 'PO-8686',
            'department' => 'test',
            'phone' => $request->phone,
            'address' => 'Yaounde',
            'blood_group' => 'A+',
            'createdAt' => $user->created_at->format('Y-m-d\TH:i:s.u\Z'),
            'updatedAt' => $user->updated_at->format('Y-m-d\TH:i:s.u\Z'),
        ]);

        $patient = new Patient();
        $patient->user_id = $user->id;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        $patient->birthday = '00-00-0000';
        $patient->save();

        if ($response->failed()) {
            return \Redirect::route('user.all')->with('error', __('sentence.User synchronization failed'));
        }

        return \Redirect::route('user.all')->with('success', __('sentence.User Created Successfully'));
    }

    public function edit($id)
    {
        $user = User::findorfail($id);
        $roles = Role::all();

        return view('user.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => [
            //     'required', 'email', 'max:255',
            //     Rule::unique('users')->ignore($request->user_id),
            // ],
            'role_id' => ['required', 'numeric'],
            'fonction' => ['required', 'array', Rule::in([
                'Praticien Main',
                'Praticien Peau',
                'Praticien Pied',
                'Dermatologue',
            ])],
        ]);

        $user = User::find($request->user_id);
        $user->password = \Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->fonction = json_encode($request->fonction);
        $role = Role::findById($request->role_id);
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
        // If the role exists, assign it to the user
        if ($role) {
            $user->assignRole($role);
        } else {
            return \Redirect::route('user.all')->with('error', __('sentence.role id does not exist'));
        }
        $user->update();

        $patient = Patient::where('user_id', '=', $request->user_id)
            ->update([
                'birthday' => '00-00-0000',
                'phone' => $request->phone,
                'gender' => $request->gender,
            ]);

        return \Redirect::route('user.all')->with('success', __('sentence.User Updated Successfully'));
    }

    public function searchfonction(Request $request){
        $term = $request->term;

        $praticiens = User::where('name', 'LIKE', '%' . $term . '%')->OrderBy('id', 'DESC')->paginate(10);

        return view('appointment.rdvPraticien', ['praticiens' => $praticiens]);
    }

}
