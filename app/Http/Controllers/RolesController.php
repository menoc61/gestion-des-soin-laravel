<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Redirect;

class RolesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function all_roles(){

        $roles = Role::paginate(10);
        return view('role.all', ['roles' => $roles]);

    }


    public function create(){
        
        $permissions = Permission::all();

        return view('role.create', ['permissions' => $permissions]);
    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required',
        ]);

        $role = Role::create(['name' => $request->name]);

        $role->syncPermissions($request->permissions);

        return Redirect::route('roles.all')->with('success', __('sentence.Role Created Successfully'));
    }


    public function edit_role(Request $request,$id){
        
        $role = Role::findorfail($id);
        $permissions = Permission::all();

        return view('role.edit', ['role' => $role, 'permissions' => $permissions]);
    }

    public function store_edit_role(Request $request){
        
        $this->validate($request, [
            'name' => 'required',
        ]);

            $role = Role::findorfail($request->role_id);
                if($role->name != 'Admin' and $role->name != 'Receptionist'):
                    $role->name = $request->name;
                endif;
            $role->update();

        $role->syncPermissions($request->permissions);
        return Redirect::route('roles.all')->with('success', __('sentence.Role Updated Successfully'));
    }

    public function destroy($id){
        
        $role = Role::findorfail($id);

        if($role->name == 'Admin' or $role->name == 'Receptionist'):
            return Redirect::route('roles.all')->with('warning', 'You cannot delete Admin/Receptionist role !');;
        endif;
        
        Role::destroy($id);
        return Redirect::route('roles.all')->with('success', 'Role Deleted Successfully!');;
    }
}
