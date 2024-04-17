<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendSmsNotification extends Notification
{
    use Queueable;
    public $appointment;


    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }


    public function via($notifiable)
    {
        return ['sms'];
    }

    public function toTwilio($notifiable)
    {
        return (new TwilioMessage())
            ->content("Hello, this is your SMS message!");
    }


}
