<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Notifications\NewAppointmentByEmailNotification;
use App\Notifications\WhatsAppNotification;
use App\Prescription;
use App\Setting;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $patients = User::where('role_id', '3')->get();

        return view('appointment.create', ['patients' => $patients]);
    }

    public function create_By_id($id)
    {
        $user = User::findOrFail($id);
        $praticiens = User::where('role_id', '!=', 3)->get();
        $user_auth = Auth::user();

        $datesByPraticien = [];
        foreach ($praticiens as $praticien) {
            $dates = Appointment::where('doctor_id', $praticien->id)
                ->pluck('date')
                ->map(function ($date) {
                    return Carbon::parse($date)->format('Y-m-d');
                })
                ->toArray();
            $datesByPraticien[$praticien->id] = $dates;
        }

        return view('appointment.create_By_user', [
            'userName' => $user->name,
            'praticiens' => $praticiens,
            'user_auth' => $user_auth,
            'userId' => $id,
            'datesByPraticien' => $datesByPraticien,
        ]);
    }

    public function rdv_praticien_By_id($pres_id, $id)
    {
        $user = User::findOrFail($id);
        $prescription = Prescription::findOrFail($pres_id);
        $praticiens = User::where('role_id', '!=', 3)->get();
        $user_auth = Auth::user();


        return view('appointment.rdvPraticien', [
            'userName' => $user->name,
            'praticiens' => $praticiens,
            'user_auth' => $user_auth,
            'userId' => $id,
            'prescription' => $prescription
        ]);
    }

    public function rdv_praticien ($id, $doc_id)
    {
        $user = User::findOrFail($id);
        $praticien = User::findOrFail($doc_id);
        $user_auth = Auth::user();
        $appointmentsDoc = Appointment::where('doctor_id', $doc_id)->get();

        return view('appointment.rdv', [
            'userName' => $user->name,
            'praticienName' => $praticien->name,
            'user_auth' => $user_auth,
            'patientId' => $id, // Utilisez $id comme $patientId
            'docId' => $doc_id,
            'appointmentsDoc' => $appointmentsDoc
        ]);
    }

    // public function checkslots($date)
    // {
    //     return $this->getTimeSlot($date);
    // }

    // public function available_slot($date, $start, $end)
    // {
    //     $check = Appointment::where('date', $date)->where('time_start', $start)->where('time_end', $end)->where('visited', '!=', '2')->count();
    //     if ($check == 0) {
    //         return 'available';
    //     } else {
    //         return 'unavailable';
    //     }
    // }

    // public function getTimeSlot($date)
    // {
    //     $day = date('l', strtotime($date));
    //     $day_from = strtolower($day . '_from');
    //     $day_to = strtolower($day . '_to');

    //     $start = Setting::get_option($day_from);
    //     $end = Setting::get_option($day_to);
    //     $interval = Setting::get_option('appointment_interval');

    //     $start = new \DateTime($start);
    //     $end = new \DateTime($end);
    //     $start_time = $start->format('H:i'); // Get time Format in Hour and minutes
    //     $end_time = $end->format('H:i');

    //     $i = 0;
    //     $time = [];
    //     while (strtotime($start_time) <= strtotime($end_time)) {
    //         $start = $start_time;
    //         $end = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($start_time)));
    //         $start_time = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($start_time)));
    //         ++$i;
    //         if (strtotime($start_time) <= strtotime($end_time)) {
    //             $time[$i]['start'] = $start;
    //             $time[$i]['end'] = $end;
    //             $time[$i]['available'] = $this->available_slot($date, $start, $end);
    //         }
    //     }

    //     return $time;
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'doctor_id' => ['required', 'exists:users,id'],
            'patient' => ['required', 'exists:users,id'],
            'rdv_time_date' => ['required'],
            'rdv_time_start' => ['required'],
            'rdv_time_end' => ['required'],
            'send_sms' => ['boolean'],
            'prescription_id' => ['required','exists:prescriptions,id']
        ]);

        $appointment = new Appointment();
        $appointment->user_id = $request->patient;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->date = $request->rdv_time_date;
        $appointment->time_start = $request->rdv_time_start;
        $appointment->time_end = $request->rdv_time_end;
        $appointment->visited = 0;
        $appointment->reason = $request->reason;
        $appointment->prescription_id = $request->prescription_id;
        $appointment->save();

        if ($request->send_sms == 1) {
            $user = User::findOrFail($request->patient);
            $phone = $user->Patient->phone;

            \Nexmo::message()->send([
                'to' => $phone,
                'from' => '213794616181',
                'text' => 'You have an appointment on ' . $request->rdv_time_date . ' at ' . $request->rdv_time_start . ' at Sai i lama',
            ]);
        }

        if (\Auth::user()->role_id == 3) {
            return back()->with('success', 'Rendez-vous crée avec succès!');
        } else {
            return back()->with('success', 'Appointment Created Successfully!');
        }
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'rdv_id' => ['required', 'exists:appointments,id'],
            'rdv_status' => ['required', 'numeric'],
        ]);

        $appointment = Appointment::findOrFail($request->rdv_id);
        $appointment->visited = $request->rdv_status;
        $appointment->save();

        return \Redirect::back()->with('success', 'Appointment Updated Successfully!');
    }

    public function all()
    {
        $user = \Auth::user();
        $appointments = Appointment::orderBy('id', 'DESC')->paginate(25);
        $Myappointments = Appointment::where('user_id', $user);

        return view('appointment.all', ['appointments' => $appointments, 'Myappointments' => $Myappointments]);
    }

    public function calendar()
    {
        $appointments = Appointment::orderBy('id', 'DESC')->paginate(25);

        return view('appointment.calendar', ['appointments' => $appointments]);
    }

    public function pending()
    {
        if (\Auth::user()->role == '3') {
            $appointments = Appointment::where('user_id', Auth()->id())->where('visited', 0)->orderBy('date', 'ASC')->paginate(25);
        } else {
            $appointments = Appointment::where('visited', 0)->orderBy('date', 'ASC')->paginate(25);
        }

        return view('appointment.all', ['appointments' => $appointments]);
    }

    public function treated()
    {
        if (\Auth::user()->role == '3') {
            $appointments = Appointment::where('user_id', Auth()->id())->where('visited', 1)->orderBy('date', 'ASC')->paginate(25);
        } else {
            $appointments = Appointment::where('visited', 1)->orderBy('date', 'ASC')->paginate(25);
        }

        return view('appointment.all', ['appointments' => $appointments]);
    }

    public function cancelled()
    {
        if (\Auth::user()->role == '3') {
            $appointments = Appointment::where('user_id', Auth()->id())->where('visited', 2)->orderBy('date', 'ASC')->paginate(25);
        } else {
            $appointments = Appointment::where('visited', 2)->orderBy('date', 'ASC')->paginate(25);
        }

        return view('appointment.all', ['appointments' => $appointments]);
    }

    public function today()
    {
        if (\Auth::user()->role == '3') {
            $appointments = Appointment::where('user_id', Auth()->id())->where('date', today())->orderBy('date', 'DESC')->paginate(25);
        } else {
            $appointments = Appointment::where('date', today())->orderBy('date', 'DESC')->paginate(25);
        }

        return view('appointment.all', ['appointments' => $appointments]);
    }

    public function destroy($id)
    {
        Appointment::destroy($id);

        return back()->with('success', 'Appointment Deleted Successfully!');
    }

    public function notify_whatsapp($id)
    {
        $appointment = Appointment::findorfail($id);

        $appointment->User->Patient->notify(new WhatsAppNotification($appointment));

        return back()->with('success', 'Patient Notified Successfully!');
    }

    public function notify_email($id)
    {
        $appointment = Appointment::findorfail($id);
        $appointment->User->notify(new NewAppointmentByEmailNotification($appointment));

        return back()->with('success', __('Patient Notified Successfully'));
    }

    public function getAppointments($id)
    {
        $userAppointments = Appointment::where('user_id', $id)->get();
        $userAppointments = $userAppointments->map(function ($item) {
            // Utilisez toDateString() pour formater la date au format "YYYY-MM-DD".
            $item->date = $item->date->toDateString();

            return $item;
        });

        return response()->json($userAppointments);
    }

    public function DetailAppointment($id, $pres_id)
    {
        $appointment = Appointment::findOrfail($id);
        $prescription = Prescription::findOrfail($pres_id);

        $currentUserAppointments = Appointment::where('id', $appointment->id)
            ->where('reason', 'like', '%' . $prescription->reference . '%')
            ->where('reason', 'like', '%' . $prescription->id . '%')
            ->orderBy('id', 'DESC')
            ->get();

        return view('appointment.detailAppointment', ['currentUserAppointments' => $currentUserAppointments, 'appointment'=>$appointment]);
    }
}
