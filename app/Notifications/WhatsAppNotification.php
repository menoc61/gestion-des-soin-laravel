<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Services\WhatsAppService;
use App\Channels\WhatsAppChannel;

class WhatsAppNotification extends Notification
{
    use Queueable;

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return [WhatsAppChannel::class];
    }

    public function toWhatsApp($notifiable)
    {
        $whatsAppService = new WhatsAppService();
        $whatsAppService->sendWhatsAppMessage($notifiable->phone, $this->message);
    }
}

//
//namespace App\Notifications;
//
//use App\Channels\Messages\WhatsAppMessage;
//use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Notifications\Messages\MailMessage;
//use Illuminate\Notifications\Notification;
//use Twilio\Rest\Client;
//use App\Channels\WhatsAppChannel;
//use App\Appointment;
//
//class WhatsAppNotification extends Notification
//{
//    use Queueable;
//    public $appointment;
//
//
//    public function __construct(Appointment $appointment)
//    {
//    $this->appointment = $appointment;
//  }
//
//
//    public function via($notifiable)
//    {
//        return [WhatsAppChannel::class];
//    }
//
//    public function toWhatsApp($notifiable)
//    {
//  
//      return (new WhatsAppMessage)
//          ->content(__('Your appointment is coming up on') .' '.$this->appointment->date->toFormattedDateString().' '. __('at').' '. $this->appointment->time_start. __(', please be on time'));
//    }
// } -->

