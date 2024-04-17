<?php

namespace App\Http\Controllers;

use App\Patient;
use App\User;
use App\Waiting_room;
use Illuminate\Http\Request;

class WaitingroomController extends Controller
{
    public function view()
    {
        $list = Waiting_room::where('status', '!=', 3)->orderby('status', 'DESC')->get();
        $users = User::where('role_id', '3')->get();

        return view('waiting_room.view', ['list' => $list, 'users' => $users]);
    }

    public function view_archive()
    {
        $list = Waiting_room::where('status', 3)->get();

        return view('waiting_room.archive', ['list' => $list]);
    }

    public function archive()
    {
        $list = Waiting_room::where('status', '!=', 3);
        $list->update(['status' => 3]);

        return \Redirect::back()->with('success', 'List archived successfully');
    }

    public function update_to_ongoing($id)
    {
        $list = Waiting_room::where('status', 2);
        $list->update(['status' => 3]);

        $last = Waiting_room::where('id', $id);
        $last->update(['status' => 2]);

        return \Redirect::back()->with('success', 'Visit updated successfully');
    }

    public function update_to_archive($id)
    {
        $list = Waiting_room::where('id', $id);
        $list->update(['status' => 3]);

        return \Redirect::back()->with('success', 'List archived successfully');
    }

    public function store(Request $request)
    {
        if ($request->new_patient == 1) {
            request()->merge(['name' => $request->firstname.' '.$request->familyname]);

            $validatedData = $request->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'familyname' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            ]);

            $user = new User();
            $user->password = \Hash::make(\Str::random(5));
            $user->name = $request->firstname.' '.$request->familyname;
            $user->role = '3';
            $user->save();

            $patient = new Patient();
            $patient->user_id = $user->id;

            $patient->save();
        } else {
            $validatedData = $request->validate([
                'patient' => ['required', 'exists:users,id'],
            ]);
            $user = User::find($request->patient);
        }

        $request->has_appointment ? $has_appointment = 1 : $has_appointment = 0;

        $visitor = new Waiting_room();
        $visitor->user_id = $user->id;
        $visitor->reason = $request->reason;
        $visitor->has_appointment = $has_appointment;
        $visitor->status = 1;
        $visitor->save();

        return \Redirect::route('wr.view')->with('success', 'Visitor added successfully');
    }

    public function delete($id)
    {
        $list = Waiting_room::findorfail($id);
        $list->delete();

        return \Redirect::back()->with('success', 'Visitor deleted successfully');
    }

    public function search(Request $request)
    {
        $list = Waiting_room::where('status', '!=', 3)
                    ->whereHas('user', function ($query) use ($request) {
                        $query->where('name', 'like', '%'.$request->visitor.'%');
                    })
                    ->get();
        $users = User::where('role_id', '3')->get();

        return view('waiting_room.view', ['list' => $list, 'users' => $users]);
    }

    public function search_in_archive(Request $request)
    {
        $list = Waiting_room::where('status', 3)
                    ->whereHas('user', function ($query) use ($request) {
                        $query->where('name', 'like', '%'.$request->visitor.'%');
                    })
                    ->get();
        $users = User::where('role_id', '3')->get();

        return view('waiting_room.archive', ['list' => $list, 'users' => $users]);
    }

    public function filter(Request $request)
    {
        $date = $request->date;
        // return date('Y-m-d', strtotime($date));
        $list = Waiting_room::where('status', '=', 3)->whereDate('created_at', $request->date)->get();

        return view('waiting_room.archive', ['list' => $list, 'date' => $date]);
    }
}
