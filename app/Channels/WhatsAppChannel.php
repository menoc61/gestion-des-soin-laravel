<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use App\Services\WhatsAppService;

class WhatsAppChannel
{
    public function send($notifiable, Notification $notification)
    {
        if (method_exists($notification, 'toWhatsApp')) {
            $message = $notification->toWhatsApp($notifiable);
            $whatsAppService = new WhatsAppService();
            $whatsAppService->sendWhatsAppMessage($notifiable->phone, $message);
        }
    }
}

//<?php
//namespace App\Channels;

//use Illuminate\Notifications\Notification;
//use Twilio\Rest\Client;

//class WhatsAppChannel
//{
  //  public function send($notifiable, Notification $notification)
    //{
      //  $message = $notification->toWhatsApp($notifiable);


//        $to = $notifiable->routeNotificationFor('WhatsApp');
  //      $from = config('services.twilio.whatsapp_from');


//        $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));


//        return $twilio->messages->create('whatsapp:' . $to, [
  //          "from" => 'whatsapp:' . $from,
    //        "body" => $message->content
      //  ]);
//    }
//}