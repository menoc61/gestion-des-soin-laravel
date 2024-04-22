<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Prescription;
use App\Appointment;
use App\Billing;
use App\Billing_item;
use App;
use App\Test;
use Auth;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
    public function index()
    {

        $user = Auth::user();
        $doctorId = $user->id;
        //$user->assignRole('admin');
        //$user->syncRoles(['assistant']);

        //$role = Role::create(['name' => 'admin']);
        //1$role = Role::create(['name' => 'assistant']);

        //$role = Role::findById(4); $role->givePermissionTo(Permission::all());

        //$permission = Permission::create(['name' => 'manage roles']);

        /*

$permission = Permission::create(['name' => 'view patient']);
$permission = Permission::create(['name' => 'view all patients']);
$permission = Permission::create(['name' => 'delete patient']);

$permission = Permission::create(['name' => 'create health history']);
$permission = Permission::create(['name' => 'delete health history']);

$permission = Permission::create(['name' => 'add medical files']);
$permission = Permission::create(['name' => 'delete medical files']);


$permission = Permission::create(['name' => 'create appointment']);
$permission = Permission::create(['name' => 'view all appointments']);
$permission = Permission::create(['name' => 'delete appointment']);

$permission = Permission::create(['name' => 'create prescription']);
$permission = Permission::create(['name' => 'view prescription']);
$permission = Permission::create(['name' => 'view all prescriptions']);
$permission = Permission::create(['name' => 'edit prescription']);
$permission = Permission::create(['name' => 'delete prescription']);
$permission = Permission::create(['name' => 'print prescription']);


$permission = Permission::create(['name' => 'create drug']);
$permission = Permission::create(['name' => 'edit drug']);
$permission = Permission::create(['name' => 'view drug']);
$permission = Permission::create(['name' => 'view all drugs']);

$permission = Permission::create(['name' => 'create diagnostic test']);
$permission = Permission::create(['name' => 'edit diagnostic test']);
$permission = Permission::create(['name' => 'view all diagnostic tests']);

$permission = Permission::create(['name' => 'create invoice']);
$permission = Permission::create(['name' => 'edit invoice']);
$permission = Permission::create(['name' => 'view invoice']);
$permission = Permission::create(['name' => 'view all invoices']);
$permission = Permission::create(['name' => 'delete invoice']);

*/

        // Home concernant le Praticien
        $total_prescriptions_for_pratician = Prescription::where('doctor_id',$doctorId)->count();
        $total_tests_for_pratician = Test::where('created_by',$doctorId)->count();
        $total_amount_for_pratician = Billing::where('created_by',$doctorId)->sum('total_with_tax');
        // Home concernant l'Admin
        $total_patients = User::where('role_id', '3')->count();
        $total_patients_today = User::where('role_id', '3')->wheredate('created_at', Today())->count();
        $total_appointments = Appointment::all()->count();
        $total_appointments_today = Appointment::wheredate('date', Today())->get();
        $total_prescriptions = Prescription::all()->count();
        $total_payments = Billing::all()->count();
        $total_payments = Billing::all()->count();
        $total_payments_month = Billing_item::whereMonth('created_at', date('m'))->sum('invoice_amount');
        $total_payments_month = Billing_item::whereMonth('created_at', date('m'))->sum('invoice_amount');
        $total_payments_year = Billing_item::whereYear('created_at', date('Y'))->sum('invoice_amount');

        $total_payment_by_month = Billing_item::select('id', 'created_at','invoice_amount')->get()->groupBy(
            function ($total_payment_by_month) {
                return Carbon::parse($total_payment_by_month->created_at)->format('F Y');
            }
        );
        $months = [];
        $monthCount = [];
        $totalAmounts = [];
        foreach ($total_payment_by_month as $month => $values) {
            $months[] = $month;
            $monthCount[] = count($values);
            $totalAmount = $values->sum('invoice_amount');
            $totalAmounts[] = $totalAmount;
        }

        $visitedCount = Appointment::all()->where('visited', 1)->count();
        $nonVisitedCount = Appointment::all()->where('visited', 0)->count();
        $allAppointment = Appointment::all()->count();

        // $total_payment_by_month = Billing_item::select('id', 'created_at')->get()->groupBy(
        //     function ($total_payment_by_month) {
        //         return Carbon::parse($total_payment_by_month->created_at)->format('F');
        //     }
        // );
        // $months = [];
        // $monthCount = [];
        // foreach ($total_payment_by_month as $month => $values) {
        //     $months[] = $month;
        //     $monthCount[] = count($values);
        // }


        return view('home', [
            'total_patients' => $total_patients,
            'total_prescriptions' => $total_prescriptions,
            'total_patients_today' => $total_patients_today,
            'total_appointments' => $total_appointments,
            'total_appointments_today' => $total_appointments_today,
            'total_payments' => $total_payments,
            'total_payments_month' => $total_payments_month,
            'total_payments_year' => $total_payments_year,
            'total_payment_by_month' => $total_payment_by_month,
            'totalAmounts'=> $totalAmounts,
            'months' => $months,
            'monthCount' => $monthCount,
            'total_prescriptions_for_pratician' => $total_prescriptions_for_pratician,
            'total_tests_for_pratician'=> $total_tests_for_pratician,
            'total_amount_for_pratician' => $total_amount_for_pratician,
            'visitedCount'=>$visitedCount,
            'nonVisitedCount'=>$nonVisitedCount,
            'allAppointment'=>$allAppointment
        ]);
    }

    public function lang($locale)
    {

        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
