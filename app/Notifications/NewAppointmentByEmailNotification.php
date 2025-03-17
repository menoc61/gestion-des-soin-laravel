<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Appointment;

class NewAppointmentByEmailNotification extends Notification
{
    use Queueable;

    public $appointment;


    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmation du Rendez-vous: ['.$notifiable->name.'], à Saï i lama') 

            ->line('N\'oubliez pas votre Rendez-vous d\'aujourd\'ui.')
            ->line('Details du RDV:')
            ->line('Date: ' . $this->appointment->date->format('d-m-Y'))
            ->line('Heure de debut: ' . $this->appointment->time_start)
            ->line('Heure de Fin: ' . $this->appointment->time_end)
            ->action('Se connecter', route('login'))
            ->line('Merci d\'avoir choisi notre service ! :) ')
            ->line('Le bien-être est notre prédilection ');
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
