<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Billing;
use App\Drug;
use App\Notifications\NewAppointmentByEmailNotification;
use App\Notifications\WhatsAppNotification;
use App\Prescription;
use App\Rdv_Drug;
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
        $praticiens = User::where('role_id', '!=', 3)->get();
        $other_praticients = User::where('role_id', '!=', 3)->get();
        $drugs = Drug::all();


        return view('appointment.create', ['patients' => $patients, 'praticiens' => $praticiens, 'other_praticiens' => $other_praticiens, 'drugs' => $drugs,]);
    }

    public function create_By_id($id)
    {
        $user = User::findOrFail($id);
        $user_auth = Auth::user();
        $drugs = Drug::all();

        $praticiens = User::where('role_id', '!=', 3)->get();
        $other_praticiens = User::where('role_id', '!=', 3)->get();

        return view('appointment.create_by_user', [
            'userName' => $user->name,
            'praticiens' => $praticiens,
            'user_auth' => $user_auth,
            'userId' => $id,
            'drugs' => $drugs,
            'other_praticiens' => $other_praticiens,
        ]);
    }

    public function edit_appointment($id)
    {
        // Rechercher le rendez-vous par son identifiant ou retourner une erreur 404 s'il n'existe pas
        $appointment = Appointment::findOrFail($id);

        // Trouver l'utilisateur lié au rendez-vous
        $user = User::findOrFail($appointment->user_id);

        // Récupérer l'utilisateur actuellement authentifié
        $user_auth = Auth::user();

        // Récupérer la liste des médicaments et des praticiens
        $drugs = Drug::all();
        $praticiens = User::where('role_id', '!=', 3)->get();
        $other_praticiens = User::where('role_id', '!=', 3)->get();


        // Retourner la vue d'édition avec les données actuelles du rendez-vous
        return view('appointment.edit_appointment', [
            'userName' => $user->name,
            'praticiens' => $praticiens,
            'other_praticiens' => $other_praticiens,
            'user_auth' => $user_auth,
            'userId' => $user->id,
            'appointment' => $appointment,
            'drugs' => $drugs,
        ]);
    }


    public function rdv_praticien_By_id($pres_id, $id)
    {
        $user = User::findOrFail($id);
        $prescription = Prescription::findOrFail($pres_id);
        $praticiens = User::where('role_id', '!=', 3)->get();
        $other_praticiens = User::where('role_id', '!=', 3)->get();
        $user_auth = Auth::user();


        return view('appointment.rdvPraticien', [
            'userName' => $user->name,
            'praticiens' => $praticiens,
            'other_praticiens' => $other_praticiens,
            'user_auth' => $user_auth,
            'userId' => $id,
            'prescription' => $prescription
        ]);
    }

    public function rdv_praticien($id, $doc_id)
    {
        $user = User::findOrFail($id);
        $praticien = User::findOrFail($doc_id);
        $other_praticiens = Praticient::with('user')->whereHas('appointments', function ($query) use ($doc_id) {
            $query->where('doctor_id', $doc_id);
        })->get();
        $user_auth = Auth::user();
        $appointmentsDoc = Appointment::where('doctor_id', $doc_id)->get();

        return view('appointment.rdv', [
            'userName' => $user->name,
            'praticienName' => $praticien->name,
            'other_praticiens' => $other_praticiens,
            'user_auth' => $user_auth,
            'patientId' => $id, // Utilisez $id comme $patientId
            'docId' => $doc_id,
            'appointmentsDoc' => $appointmentsDoc
        ]);
    }



    public function checkslots($date)
    {
        return $this->getTimeSlot($date);
    }

    public function available_slot($date, $start, $end)
    {
        $check = Appointment::where('date', $date)->where('time_start', $start)->where('time_end', $end)->where('visited', '!=', '2')->count();
        if ($check == 0) {
            return 'available';
        } else {
            return 'unavailable';
        }
    }

    public function getTimeSlot($date)
    {
        $day = date('l', strtotime($date));
        $day_from = strtolower($day . '_from');
        $day_to = strtolower($day . '_to');

        $start = Setting::get_option($day_from);
        $end = Setting::get_option($day_to);
        $interval = Setting::get_option('appointment_interval');

        $start = new \DateTime($start);
        $end = new \DateTime($end);
        $start_time = $start->format('H:i'); // Get time Format in Hour and minutes
        $end_time = $end->format('H:i');

        $i = 0;
        $time = [];
        while (strtotime($start_time) <= strtotime($end_time)) {
            $start = $start_time;
            $end = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($start_time)));
            $start_time = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($start_time)));
            ++$i;
            if (strtotime($start_time) <= strtotime($end_time)) {
                $time[$i]['start'] = $start;
                $time[$i]['end'] = $end;
                $time[$i]['available'] = $this->available_slot($date, $start, $end);
            }
        }

        return $time;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'doctor_id' => ['required', 'exists:users,id'],
            'praticient_id' => ['nullable', 'array'], // Accepter plusieurs praticiens
            'praticient_id.*' => ['exists:users,id'], // Vérifier chaque ID
            'patient' => ['required', 'exists:users,id'],
            'rdv_time_date' => ['required'],
            'rdv_time_start' => ['required'],
            'rdv_time_end' => ['required'],
            'send_sms' => ['boolean'],
        ]);

        $appointment = new Appointment();
        $appointment->user_id = $request->patient;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->date = $request->rdv_time_date;
        $appointment->time_start = $request->rdv_time_start;
        $appointment->time_end = $request->rdv_time_end;
        $appointment->visited = 0;
        $appointment->is_read = 0;
        $appointment->reason = $request->reason;
        $appointment->rapport = $request->rapport;
        $appointment->prescription_id = $request->prescription_id;
        
        $appointment->save();
        
        if ($request->has('praticient_id') && !empty($request->praticient_id)) {
            $appointment->praticients()->sync($request->praticient_id);
        }

        if ($request->send_sms == 1) {
            $user = User::findOrFail($request->patient);
            $phone = $user->Patient->phone;

            \Nexmo::message()->send([
                'to' => $phone,
                'from' => '213794616181',
                'text' => 'You have an appointment on ' . $request->rdv_time_date . ' at ' . $request->rdv_time_start . ' at Sai i lama',
            ]);
        }

        if (isset($request->trade_name)) {
            $i = count($request->trade_name);

            for ($x = 0; $x < $i; ++$x) {
                if ($request->trade_name[$x] != null) {
                    $add_drug = new Rdv_Drug();
                    $add_drug->strength = $request->input('strength.' . $x) ?? null;
                    $add_drug->dose = $request->input('dose.' . $x) ?? null;
                    $add_drug->duration = $request->input('duration.' . $x) ?? null;
                    $add_drug->drug_advice = $request->input('drug_advice.' . $x) ?? null;
                    $add_drug->appointment_id = $appointment->id;
                    $add_drug->drug_id = $request->input('trade_name.' . $x) ?? null;

                    // Récupération de l'élément de la table "drug" correspondant à "drug_id"
                    $drug = Drug::find($add_drug->drug_id);

                    // Accéder aux propriétés de l'élément "drug" récupéré
                    if ($drug) {
                        $nomDuDrug = $drug->amountDrug; // Remplacez "nom" par le nom de la propriété que vous souhaitez récupérer
                        // Utilisez la valeur récupérée selon vos besoins
                    }
                    $add_drug->montant_drug = $nomDuDrug;

                    $add_drug->save();
                }
            }
        }

        if (\Auth::user()->role_id == 3) {
            return back()->with('success', 'Rendez-vous crée avec succès!');
        } else {
            return \Redirect::route('billing.create_by', ['id' => $appointment->user_id])->with('success', 'Rendez-vous crée avec succès!');
        }
    }

    public function store_edit(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'rdv_id' => ['required', 'exists:appointments,id'],
            'rdv_status' => ['required', 'numeric'],
            'is_read' => ['required']
        ]);

        $appointment = Appointment::findOrFail($request->rdv_id);
        $appointment->visited = $request->rdv_status;
        $appointment->is_read = $request->is_read;
        $appointment->rapport = $request->rapport;
        $appointment->save();

        return \Redirect::route('patient.view', ['id' => $appointment->user_id]);
    }

    public function store_edit_appointment(Request $request)
    {
        $validatedData = $request->validate([
            'doctor_id' => ['required', 'exists:users,id'],
            'praticient_id' => ['nullable', 'array'], // Accepter plusieurs praticiens
            'praticient_id.*' => ['exists:users,id'], // Vérifier chaque ID
            'patient' => ['required', 'exists:users,id'],
            'rdv_time_date' => ['required', 'date'],
            'rdv_time_start' => ['required'],
            'rdv_time_end' => ['required'],
            'send_sms' => ['boolean'],
        ]);
    
        $appointment = Appointment::findOrFail($request->rdv_id);
        $appointment->user_id = $request->patient;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->date = $request->rdv_time_date;
        $appointment->time_start = $request->rdv_time_start;
        $appointment->time_end = $request->rdv_time_end;
        $appointment->reason = $request->reason;
        $appointment->rapport = $request->rapport;
        $appointment->save();
    
        // Gestion des soins/médicaments
        if ($request->has('praticient_id') && !empty($request->praticient_id)) {
            $appointment->praticients()->sync($request->praticient_id);
        } 

        if ($request->has('trade_name')) {
            // Supprimer les anciens médicaments liés à ce rendez-vous
            Rdv_Drug::where('appointment_id', $appointment->id)->delete();
        
            $i = count($request->trade_name);
            for ($x = 0; $x < $i; ++$x) {
                if ($request->trade_name[$x] != null) {
                    $add_drug = new Rdv_Drug();
                    $add_drug->strength = $request->input('strength.' . $x) ?? null;
                    $add_drug->dose = $request->input('dose.' . $x) ?? null;
                    $add_drug->duration = $request->input('duration.' . $x) ?? null;
                    $add_drug->drug_advice = $request->input('drug_advice.' . $x) ?? null;
                    $add_drug->appointment_id = $appointment->id;
                    $add_drug->drug_id = $request->input('trade_name.' . $x) ?? null;
        
                    // Récupérer le montant du médicament
                    $drug = Drug::find($add_drug->drug_id);
                    if ($drug) {
                        $add_drug->montant_drug = $drug->amountDrug;
                    }
        
                    $add_drug->save();
                }
            }
        }
        
        //dd($appointment->praticients, $appointment->drugs);
    
        // Envoi du SMS si nécessaire
        if ($request->send_sms == 1) {
            $user = User::findOrFail($request->patient);
            $phone = $user->Patient->phone;
    
            \Nexmo::message()->send([
                'to' => $phone,
                'from' => '213794616181',
                'text' => 'Your appointment has been updated to ' . $request->rdv_time_date . ' at ' . $request->rdv_time_start . ' at Sai i lama',
            ]);
        }

        return redirect()->route('patient.view', ['id' => $appointment->user_id])->with('success', 'Appointment updated successfully!');

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
            $appointments = Appointment::where('user_id', Auth()->id())->where('visited', 0)->orderBy('date', 'DESC')->paginate(25);
        } else {
            $appointments = Appointment::where('visited', 0)->where('date', '>=', Carbon::today())->orderBy('date', 'DESC')->paginate(25);
        }

        return view('appointment.all', ['appointments' => $appointments]);
    }

    public function treated()
    {
        if (\Auth::user()->role == '3') {
            $appointments = Appointment::where('user_id', Auth()->id())->where('visited', 1)->orderBy('date', 'DESC')->paginate(25);
        } else {
            $appointments = Appointment::where('visited', 1)->orderBy('date', 'DESC')->paginate(25);
        }

        return view('appointment.all', ['appointments' => $appointments]);
    }

    public function cancelled()
    {
        if (\Auth::user()->role == '3') {
            $appointments = Appointment::where('user_id', Auth()->id())->where('date', '<', Carbon::today())->where('visited', '!=', 1)->orderBy('date', 'DESC')->paginate(25);
        } else {
            $appointments = Appointment::where('date', '<', Carbon::today())
               ->where('visited', '!=', 1)
               ->orWhere('visited', 2)
               ->orderBy('date', 'DESC')->paginate(25);
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

        return back()->with('success', 'Rendez-Vous Supprimé avec Succès!');
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

        return view('appointment.detailAppointment', ['currentUserAppointments' => $currentUserAppointments, 'appointment' => $appointment]);
    }

    public function getAppointmentsByDoctor($doctorId)
    {
        // Récupérer les rendez-vous du praticien avec les informations formatées
        $userAppointments = Appointment::where('doctor_id', $doctorId)->where('visited', 0)
            ->get()
            ->map(function ($appointment) {
                return [
                    'date' => $appointment->date->format('d M Y'),
                    'time_start' => $appointment->time_start,
                    'time_end' => $appointment->time_end,
                    'created_at' => $appointment->created_at->format('d M Y H:i'),
                ];
            });

        return response()->json($userAppointments);
    }

    public function getAppointmentsByPraticient($praticientId)
    {
        $appointments = Appointment::whereHas('praticients', function ($query) use ($praticientId) {
            $query->where('users.id', $praticientId);
        })
        ->where('visited', 0)
        ->get()
        ->map(function ($appointment) {
            return [
                'date' => $appointment->date->format('d M Y'),
                'time_start' => $appointment->time_start,
                'time_end' => $appointment->time_end,
                'created_at' => $appointment->created_at->format('d M Y H:i'),
            ];
        });

    return response()->json($appointments);
    }


    public function checkAvailability($doctor_id, $date)
    {
        // Récupérer les rendez-vous existants pour le praticien et la date donnés
        $appointments = Appointment::where('doctor_id', $doctor_id)
            ->whereDate('rdv_time_date', $date)
            ->get(['rdv_time_start', 'rdv_time_end']);

        // Retourner les données sous forme de réponse JSON
        return response()->json($appointments);
    }
}
