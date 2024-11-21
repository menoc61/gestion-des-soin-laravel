<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Prescription;
use App\Appointment;
use App\Billing;
use App\Billing_item;
use App;
use App\Rdv_Drug;
use App\Test;
use Auth;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // user Authentifié
        $user = Auth::user();
        $doctorId = $user->id;

        // Dates sélectionnées par l'utilisateur
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Si aucune date n'est fournie, définis des valeurs par défaut
        if (!$startDate || !$endDate) {
            $startDate = now()->startOfMonth();  // Début du mois actuel
            $endDate = now()->endOfMonth();  // Fin du mois actuel
        }

        // // Card Home concernant l'Hote
        $appointmentHote = Appointment::whereYear('created_at', date('Y'))->where('user_id', $user->id)->count();
        $diagnoseHote = Test::whereYear('created_at', date('Y'))->where('user_id', $user->id)->count();
        $prescriptionHote = Prescription::whereYear('created_at', date('Y'))->where('user_id', $user->id)->count();
        //$total_amount_for_hote = Rdv_Drug::whereBetween('created_at', [$startDate, $endDate])->whereIn('appointment_id', $appointmentsVisitedId)->sum('montant_drug');
        // Total des depenses de l'hote a revoir
        $total_amount_for_hote = Billing::whereYear('created_at', date('Y'))->where('user_id', $user->id)->sum('total_with_tax');

         // Card Home concernant l'Admin
        // Requête pour obtenir les données entre les dates sélectionnées
        $total_appointments = Appointment::whereBetween('date', [$startDate, $endDate])->count();
        $total_patients = User::where('role_id', '3')->whereBetween('created_at', [$startDate, $endDate])->count();
        $total_prescriptions = Prescription::whereBetween('created_at', [$startDate, $endDate])->count();
        $total_payments = Billing::whereBetween('created_at', [$startDate, $endDate])->sum('total_with_tax');

        // // Card Home concernant le Praticien
        $total_prescriptions_for_pratician = Prescription::whereBetween('created_at', [$startDate, $endDate])->where('doctor_id', $doctorId)->count();
        $total_tests_for_pratician = Test::whereBetween('created_at', [$startDate, $endDate])->where('created_by', $doctorId)->count();
        $total_amount_for_pratician = Billing::whereBetween('created_at', [$startDate, $endDate])->where('created_by', $doctorId)->sum('total_with_tax');
        $agendaDoctors = Appointment::where('doctor_id', $doctorId)->where('visited', 0)->whereMonth('date', date('m'))->paginate(3);

        $total_appointments_today = Appointment::where('visited', 0)->wheredate('date', Today())->paginate(3);


        $appointmentsVisitedId = Appointment::where('visited', 1)->pluck('id');
        $total_payments_days = Rdv_Drug::whereIn('appointment_id', $appointmentsVisitedId)->wheredate('created_at', Today())->sum('montant_drug');
        // $total_payments_month = Billing_item::whereMonth('created_at', date('m'))->sum('invoice_amount');
        $total_payments_month = Rdv_Drug::whereIn('appointment_id', $appointmentsVisitedId)->whereMonth('created_at', date('m'))->sum('montant_drug');
        // $total_payments_month = Billing_item::whereMonth('created_at', date('m'))->sum('invoice_amount');
        $total_payments_year = Rdv_Drug::whereIn('appointment_id', $appointmentsVisitedId)->whereYear('created_at', date('Y'))->sum('montant_drug');
        // $total_payments_year = Billing_item::whereYear('created_at', date('Y'))->sum('invoice_amount');
        
        $countRDVread = Appointment::where('is_read', 0)->count();

        $appointments = Appointment::where('is_read', 0)->orderBy('id', 'desc')->paginate(7);


        $total_payment_by_day = Billing_item::select('created_at', 'invoice_amount')
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->created_at)->format('Y-m-d');
            });
        $days = [];
        $dayCount = [];
        $totalAmounts = [];
        foreach ($total_payment_by_day as $day => $values) {
            $days[] = $day;
            $dayCount[] = count($values);
            $totalAmount = $values->sum('invoice_amount');
            $totalAmounts[] = $totalAmount;
        }

        $visitedCount = Appointment::all()->where('visited', 1)->count();
        $nonVisitedCount = Appointment::all()->where('visited', 0)->count();
        $allAppointment = Appointment::all()->count();




        $PopularDrugs = Rdv_Drug::select('drug_id', DB::raw('count(*) as total'))
            ->groupBy('drug_id')
            ->orderBy('total', 'desc')
            ->take(2)
            ->get();

        // Obtention du premier jour du mois actuel
        $defaultStartDate = Carbon::now()->startOfMonth()->toDateString();

        // Obtention du dernier jour du mois actuel
        $defaultEndDate = Carbon::now()->endOfMonth()->toDateString();
        $nameday = Carbon::now()->formatLocalized('%A');



        // Vérifie si la requête est AJAX pour retourner les données filtrées
        if ($request->ajax()) {
            return response()->json([
                'total_patients' => $total_patients,
                'total_prescriptions' => $total_prescriptions,
                'total_appointments' => $total_appointments,
                'total_payments' => $total_payments,

                'total_amount_for_pratician' => $total_amount_for_pratician,
                'total_tests_for_pratician' => $total_tests_for_pratician,
                'total_prescriptions_for_pratician' => $total_prescriptions_for_pratician,
            ]);
        }


        return view('home', [
            'total_patients' => $total_patients,
            'total_prescriptions' => $total_prescriptions,
            'total_appointments' => $total_appointments,
            'total_payments' => $total_payments,

            'total_prescriptions_for_pratician' => $total_prescriptions_for_pratician,
            'total_tests_for_pratician' => $total_tests_for_pratician,
            'total_amount_for_pratician' => $total_amount_for_pratician,
            'agendaDoctors' => $agendaDoctors,

            'total_appointments_today' => $total_appointments_today,

            'total_payments_month' => $total_payments_month,
            'total_payments_year' => $total_payments_year,
            'total_payment_by_day' => $total_payment_by_day,
            'totalAmounts' => $totalAmounts,
            'days' => $days,
            'dayCount' => $dayCount,

            'visitedCount' => $visitedCount,
            'nonVisitedCount' => $nonVisitedCount,
            'allAppointment' => $allAppointment,
            'total_payments_days' => $total_payments_days,

            'appointmentHote' => $appointmentHote,
            'diagnoseHote' => $diagnoseHote,
            'prescriptionHote' => $prescriptionHote,
            'total_amount_for_hote' => $total_amount_for_hote,

            'defaultStartDate' => $defaultStartDate,
            'defaultEndDate' => $defaultEndDate,
            'nameday' => $nameday,
            'countRDVread' => $countRDVread,
            'appointments' => $appointments,
            'PopularDrugs' => $PopularDrugs,
        ]);
    }

    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
