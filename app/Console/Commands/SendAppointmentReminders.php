<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Appointment;
use App\User;
use Carbon\Carbon;
use App\Notifications\NewAppointmentByEmailNotification;

class SendAppointmentReminders extends Command
{
    protected $signature = 'appointments:send-reminders';
    protected $description = 'Envoie un rappel aux utilisateurs ayant un rendez-vous aujourd\'hui';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Récupérer tous les rendez-vous du jour
        $today = Carbon::today()->toDateString();

        $appointments = Appointment::whereDate('date', $today)->get();

        foreach ($appointments as $appointment) {
            $user = $appointment->user; // Supposons qu'il y ait une relation user() dans le modèle Appointment
            if ($user) {
                $user->notify(new NewAppointmentByEmailNotification($appointment));
            }
        }

        $this->info('Emails de rappel envoyés avec succès.');
    }
}
