<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Billing;
use App\Notifications\MailInvoiceNotification;
use App\User;
use Illuminate\Http\Request;

class MailInvoiceController extends Controller
{
    //
    public function envoyerNotificationAll()
    {
        // Récupérer tous les utilisateurs avec des dettes
        $usersWithDueAmount = User::whereHas('billings', function ($query) {
            $query->where('due_amount', '>', 0);
        })->get();

        // Parcourir chaque utilisateur et calculer le montant total des dettes
        foreach ($usersWithDueAmount as $user) {
            // Récupérer les IDs des rendez-vous qui ont des médicaments associés
            $appointIds = Appointment::whereHas('rdv__drugs')
                ->groupBy('id')
                ->pluck('id');

            // Récupérer les rendez-vous de l'utilisateur sans articles associés
            $appointExist = Appointment::where('user_id', $user->id)
                ->whereIn('id', $appointIds)
                ->whereDoesntHave('Items')
                ->orderBy('id', 'desc')
                ->get();

            // Récupérer les factures de l'utilisateur
            $invoices = Billing::where('user_id', $user->id)
                ->orderBy('id', 'desc')
                ->get();

            // Calculer le montant total des dettes
            $totalAmount =
                $appointExist->pluck('drugs')->flatten()->sum('amountDrug') +
                $invoices
                ->whereIn('payment_status', ['Partially Paid', 'Unpaid'])
                ->sum('due_amount');

            // Envoyer la notification par email
            $user->notify(new MailInvoiceNotification($user->name, $totalAmount));
        }

        return back()->with('success', 'Mails envoyés avec succès');
    }
}
