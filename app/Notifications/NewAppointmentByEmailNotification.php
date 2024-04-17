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
            ->subject('Appointment Confirmation: ['.$notifiable->name.'], Your Appointment is Booked') 

            ->line('Your appointment has been booked successfully.')
            ->line('Appointment Details:')
            ->line('Date: ' . $this->appointment->date)
            ->line('Start Time: ' . $this->appointment->time_start)
            ->line('End Time: ' . $this->appointment->time_end)
            ->action('View All Your Appointments', route('login'))
            ->line('Please be on time :) ')
            ->line('Thank you for choosing our service!');
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
