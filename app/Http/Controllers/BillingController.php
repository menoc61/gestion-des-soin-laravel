<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Billing;
use App\Billing_item;
use App\Payment;
use App\Prescription;
use App\Rdv_Drug;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $patients = User::where('role_id', '3')->get();

        return view('billing.create', ['patients' => $patients]);
    }

    public function create_By_id($id)
    {
        $user = User::find($id);
        if (!$user) {
        }
        // $prescriptions = Prescription::where('prescriptions.user_id', $id)->get();
        // $prescriptions = Prescription::where('user_id', $id)
        //     ->whereDoesntHave('Items')
        //     ->get();

        $appointIds = Appointment::whereHas('rdv__drugs')
            ->groupBy('id')
            ->pluck('id');

        $appointments = Appointment::where('user_id', $id)
            ->whereIn('id', $appointIds)
            ->whereDoesntHave('Items')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $appointments->load('drugs');

        return view('billing.create_by_user', ['userId' => $id, 'userName' => $user->name], compact('appointments'));
    }

    public function storeBilling(Request $request, $id)
    {
        $validatedData = $request->validate([
            'deposited_amount' => 'required|numeric|min:0',
        ]);

        $billing = Billing::findOrFail($id);

        // Enregistrer le paiement
        $payment = new Payment();
        $payment->billing_id = $billing->id;
        $payment->amount = $request->deposited_amount;
        $payment->save();

        // Mettre à jour les montants dans la facture
        $billing->deposited_amount += $request->deposited_amount;
        $billing->due_amount = $billing->total_with_tax - ($billing->deposited_amount + $billing->Remise); // Assurez-vous d'utiliser le champ correct
        // Déterminer le statut du paiement
        if ($billing->deposited_amount == 0) {
            $billing->payment_status = 'Unpaid';
        } elseif ($billing->due_amount == 0) {
            $billing->payment_status = 'Paid';
        } else {
            $billing->payment_status = 'Partially Paid';
        }

        $billing->save();

        return redirect()->route('billing.all')->with('success', 'Paiement ajouté avec succès.');
    }

    public function create_payment($id)
    {
        $billing = Billing::find($id);
        $users = User::join('billings', 'users.id', '=', 'billings.user_id')
            ->where('billings.id', $id)
            ->select('users.name', 'users.id')
            ->first();
        $billing_items = Billing_item::where('billing_id', $id)->get();

        return view('billing.payment', ['billingId' => $id], compact('billing', 'billing_items', 'users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'payment_mode' => 'required',
            'nom.*' => 'required|numeric',
            'invoice_amount.*' => ['required', 'numeric'],
            'deposited_amount' => 'nullable|numeric|',
            'due_amount' => 'nullable|numeric|',
            'payment_amount' => 'nullable|numeric|',
            'payment_date' => 'nullable|date',
        ]);

        // Validation des montants négatifs
        if ($request->deposited_amount < 0 || $request->due_amount < 0 || $request->invoice_amount < 0) {
            return \Redirect::back()->with('danger', 'Le montant ne doit pas être négatif!');
        }

        if ($request->Remise > $request->invoice_amount ) {
            return \Redirect::back()->with('danger', 'La remise ne peut pas être suppérieur au montant total à payer!');
        }


        // Déterminer le statut du paiement
        if ($request->deposited_amount == 0) {
            $request->payment_status = 'Unpaid';
        } elseif ($request->due_amount == 0) {
            $request->payment_status = 'Paid';
        } else {
            $request->payment_status = 'Partially Paid';
        }

        // Créer une nouvelle facture
        $billing = new Billing();
        $billing->user_id = $request->patient_id;
        $billing->payment_mode = $request->payment_mode;
        $billing->payment_status = $request->payment_status;
        $billing->reference = 'b' . rand(10000, 99999);
        $billing->due_amount = $request->due_amount;
        $billing->Remise = $request->Remise;
        $billing->deposited_amount = $request->deposited_amount;
        $billing->vat = Setting::get_option('vat');
        $billing->total_without_tax = collect($request->invoice_amount)->sum();
        $billing->total_with_tax = collect($request->invoice_amount)->sum() + (collect($request->invoice_amount)->sum() * Setting::get_option('vat') / 100);
        $billing->created_by = Auth::user()->id;
        $billing->save();

        // Enregistrer les éléments de facturation
        if (isset($request->nom)) {
            $i = count($request->nom);

            for ($x = 0; $x < $i; ++$x) {
                if ($request->nom[$x] != null) {
                    $billingItem = new Billing_item();
                    $billingItem->invoice_amount = $request->invoice_amount[$x];
                    $billingItem->billing_id = $billing->id;
                    $billingItem->appointment_id = $request->input('nom.' . $x) ?? null;
                    $billingItem->save();
                }
            }
        }

        // Enregistrer le paiement partiel
        if ($request->filled('deposited_amount') && $request->deposited_amount > 0) {
            $payment = new Payment();
            $payment->billing_id = $billing->id;
            $payment->amount = $request->deposited_amount;
            $payment->created_at = $request->payment_date ?? now();
            $payment->save();
        }

        return \Redirect::route('patient.view',['id' => $billing->user_id])->with('success', 'Invoice Created Successfully!');
    }


    public function all()
    {
        $sortColumn = request()->get('sort');
        $sortOrder = request()->get('order', 'asc');
        if (!empty($sortColumn)) {
            $invoices = Billing::orderby($sortColumn, $sortOrder)->paginate(25);
        } else {
            $invoices = Billing::paginate(25);
        }

        return view('billing.all', ['invoices' => $invoices]);
    }

    public function view($id)
    {
        $billing = Billing::findOrfail($id);

        $appointIds = Appointment::whereHas('rdv__drugs')
            ->groupBy('id')
            ->pluck('id');

        $appointments = Appointment::where('user_id', $id)
            ->whereIn('id', $appointIds)
            ->whereDoesntHave('Items')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $appointments->load('drugs');

        $billing_items = Billing_item::where('billing_id', $id)->whereIn('appointment_id', $appointIds)->get();

        return view('billing.view', ['billing' => $billing, 'billing_items' => $billing_items, 'appointments'=>$appointments]);
    }

    public function pdf($id)
    {
        $billing = Billing::findOrfail($id);
        $billing_items = Billing_item::where('billing_id', $id)->get();

        view()->share(['billing' => $billing, 'billing_items' => $billing_items]);
        $pdf = PDF::loadView('billing.pdf_view', ['billing' => $billing, 'billing_items' => $billing_items]);

        // download PDF file with download method
        return $pdf->download($billing->User->name . '_invoice.pdf');
    }

    public function edit($id)
    {
        $billing = Billing::findOrfail($id);

        $billing_items = Billing_item::where('billing_id', $id)->get();

        return view('billing.edit', ['billing' => $billing, 'billing_items' => $billing_items]);
    }

    public function update(Request $request)
    {
        // return $request;

        if (empty($request->nom)) {
            return \Redirect::back()->with('danger', 'Empty Invoice Details!');
        }

        $billing = Billing::findOrfail($request->billing_id);
        $billing_items = Billing_item::where('billing_id', $request->billing_id)->pluck('id')->toArray();

        if ($request->has('billing_item_id')) {
            $filtered = $request->billing_item_id;
        } else {
            $filtered = [];
        }

        foreach ($billing_items as $key => $dz) {
            $filtered[] = "$dz";
        }

        $filtered_unique = array_unique($filtered);

        $deleted_items = array_count_values($filtered);

        foreach ($deleted_items as $key => $value) {
            if ($value < 2) {
                $new_array[] = $key;

                Billing_item::destroy($key);
            }
        }

        if (isset($request->nom)) {
            $i = count($request->nom);

            for ($x = 0; $x < $i; ++$x) {
                if (isset($request->billing_item_id[$x])) {
                    Billing_item::where('id', $request->billing_item_id[$x])
                        ->update([
                            'prescription_id' => $request->nom[$x],
                            'invoice_amount' => $request->invoice_amount[$x],
                        ]);
                } else {
                    $add_item_to_invoice = new Billing_item();

                    // $add_item_to_invoice->invoice_title = $request->invoice_title[$x];
                    // $add_item_to_invoice->invoice_amount = $request->invoice_amount[$x];
                    // $add_item_to_invoice->billing_id = $request->billing_id;

                    $add_item_to_invoice->prescription_id = $request->nom[$x];
                    $add_item_to_invoice->invoice_amount = $request->invoice_amount[$x];
                    $add_item_to_invoice->billing_id = $billing->id;

                    $add_item_to_invoice->save();
                }
            }

            while ($request->deposited_amount < 0) {
                return \Redirect::back()->with('danger', 'le montant de la marchandise ne doit pas être négatif!');
            }
            if ($request->deposited_amount >= 1 && $request->deposited_amount < $request->invoice_amount) {
                $request->payment_status = 'Partially Paid';
            }
            if ($request->due_amount == 0) {
                $request->payment_status = 'Paid';
            }

            if ($request->deposited_amount == 0) {
                $request->payment_status = 'Unpaid';
            }

            $billing = Billing::find($request->billing_id);

            $billing->user_id = $request->patient_id;
            $billing->payment_mode = $request->payment_mode;
            $billing->payment_status = $request->payment_status;
            $billing->reference = 'b' . rand(10000, 99999);
            $billing->due_amount = $request->due_amount;
            $billing->deposited_amount = $request->deposited_amount;
            $billing->vat = Setting::get_option('vat');
            $billing->total_without_tax = Collect($request->invoice_amount)->sum();
            $billing->total_with_tax = Collect($request->invoice_amount)->sum() + (Collect($request->invoice_amount)->sum() * Setting::get_option('vat') / 100);
            $billing->save();
        }

        return \Redirect::route('billing.all')->with('success', 'Invoice Edited Successfully!');
    }

    public function destroy($id)
    {

        Billing::destroy($id);

        return \Redirect::route('billing.all')->with('success', 'Invoice Deleted Successfully!');
    }
}
