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

    public function all()
    {
        $sortColumn = request()->get('sort');
        $sortOrder = request()->get('order', 'asc');
        if (!empty($sortColumn)) {
            $users = User::orderBy($sortColumn, $sortOrder)->paginate(25);
        } else {
            $users = User::paginate(25);
        }
        return view('user.all', ['users' => $users]);
    }

    public function create(){
        $roles = Role::all();
        return view('user.create',['roles' => $roles]);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'role' => ['required'],

        ]);

        $user = new User();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->save();

        $patient = new Patient();
        $patient->user_id = $user->id;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        $patient->birthday = '00-00-0000';
        $patient->save();

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
            // 'role' => ['required'],

        ]);

        $user = User::findorfail($request->user_id);
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->update();


        $patient = new Patient();
        $patient->user_id = $user->id;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        $patient->birthday = '00-00-0000';
        $patient->update();

        // if(!empty($request->role)):
        //     $count_admins = User::role('Admin')->count();
        //     if($count_admins == 1 && $user->hasRole('Admin') == 1 && $request->role != "Admin"){
        //         return Redirect::route('user.all')->with('warning', __('You Cannot delete the only existant admin'));
        //     }
        //     $user->syncRoles($request->role);
        // endif;

        return Redirect::route('user.all')->with('success', __('sentence.User Updated Successfully'));

    }
}
