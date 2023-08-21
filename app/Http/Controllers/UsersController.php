<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Patient;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;
use Redirect;
use Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function all(){
        $users = User::paginate(5);
        return view('user.all', ['users' => $users]);
    }

    public function create(){

        $roles = Role::all()->pluck('name');
        return view('user.create',['roles' => $roles]);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        $user = new User();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();


        $patient = new Patient();
        $patient->user_id = $user->id;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        $patient->birthday = '00-00-0000';
        $patient->save();

        $user->assignRole($request->role);

        return Redirect::route('user.all')->with('success', __('sentence.User Created Successfully'));

    }

    public function edit($id){
        $user = User::findorfail($id);
        $roles = Role::all()->pluck('name');
        return view('user.edit',['user' => $user,'roles' => $roles]);
    }

    public function edit_profile(){
        $user = Auth::user();
        $roles = Role::all()->pluck('name');
        return view('user.edit',['user' => $user,'roles' => $roles]);
    }

    public function store_edit(Request $request){

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                    'required', 'email', 'max:255',
                    Rule::unique('users')->ignore($request->user_id),
            ],

        ]);

        $user = User::findorfail($request->user_id);
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->update();


        $patient = new Patient();
        $patient->user_id = $user->id;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        $patient->birthday = '00-00-0000';
        $patient->update();

        if(!empty($request->role)):
            $count_admins = User::role('admin')->count();
            if($count_admins == 1 && $user->hasRole('admin') == 1 && $request->role != "admin"){
                return Redirect::route('user.all')->with('warning', __('You Cannot delete the only existant admin'));
            }
            $user->syncRoles($request->role);
        endif;

        return Redirect::route('user.all')->with('success', __('sentence.User Updated Successfully'));

    }
}
