<?php

namespace App\Http\Controllers;

use App\Notifications\MailInvoiceNotification;
use App\User;
use Illuminate\Http\Request;

class MailInvoiceController extends Controller
{
    //
    public function envoyerNotificationAll()
    {
        $usersWithDueAmount = User::whereHas('billings', function ($query) {
            $query->where('due_amount', '>', 0);
        })->get();

        foreach ($usersWithDueAmount as $user) {
            $dueAmount = $user->Billings()->where('due_amount', '>', 0)->pluck('due_amount')->first();
            $user->notify(new MailInvoiceNotification($user->name, $dueAmount));
        }

        return back()->with('success', 'Mail envoyée avec succès');
    }
}
