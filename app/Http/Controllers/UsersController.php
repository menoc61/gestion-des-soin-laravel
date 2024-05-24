<?php

namespace App\Http\Controllers;

use App\Patient;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Redirect;
use Spatie\Permission\Models\Role;

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

        $patient = new Patient();
        $patient->user_id = $user->id;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        $patient->birthday = '00-00-0000';
        $patient->save();

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

}
