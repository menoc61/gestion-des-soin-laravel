<?php

namespace App\Http\Controllers\Api;

use App\Appointment;
use App\Billing;
use App\Document;
use App\History;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Prescription;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserApiController extends Controller
{

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
        ]);

        $user = new User();
        $user->password = \Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role_id = $request->role_id;

        $role = Role::findById($request->role_id);

        // If the role exists, assign it to the user
        if ($role) {
            $user->assignRole($role);
        } else {
            return back()->with('error', __('sentence.role id does not exist'));
        }
        $user->save();

        $patient = new Patient();
        $patient->user_id = $user->id;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        $patient->birthday = '00-00-0000';
        $patient->save();

        return back()->with('success', __('sentence.User Created Successfully'));
    }

    public function view($id)
    {
        $patient = User::findOrFail($id);
        $prescriptions = Prescription::where('user_id', $id)->orderBy('id', 'desc')->get();
        $appointments = Appointment::where('user_id', $id)->orderBy('id', 'desc')->get();
        $tests = Test::where('user_id', $id)->orderBy('id', 'desc')->get();
        $documents = Document::where('user_id', $id)->orderBy('id', 'desc')->get();
        $invoices = Billing::where('user_id', $id)->orderBy('id', 'desc')->get();
        $historys = History::where('user_id', $id)->orderBy('id', 'desc')->get();

        return response()->json([
            'patient' => $patient,
            'prescriptions' => $prescriptions,
            'appointments' => $appointments,
            'invoices' => $invoices,
            'documents' => $documents,
            'historys' => $historys,
            'tests' => $tests,
        ]);
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
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users')->ignore($request->user_id),
            ],
            'role_id' => ['required', 'numeric'],
        ]);

        $user = User::findorfail($request->user_id);
        $user->password = \Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role_id = $request->role_id;

        $role = Role::findById($request->role_id);

        // If the role exists, assign it to the user
        if ($role) {
            $user->assignRole($role);
        } else {
            return back()->with('error', __('sentence.role id does not exist'));
        }

        $user->update();

        $patient = new Patient();
        $patient->user_id = $user->id;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        $patient->birthday = '00-00-0000';
        $patient->update();

        return back()->with('success', __('sentence.User Updated Successfully'));
    }
}
