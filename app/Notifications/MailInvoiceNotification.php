<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailInvoiceNotification extends Notification
{
    use Queueable;

    public $userName;
    public $dueAmount;

    public function __construct($userName, $dueAmount)
    {
        $this->userName = $userName;
        $this->dueAmount = $dueAmount;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Bonjour ' . $this->userName . ',')
            ->line('Votre montant dû est de ' . $this->dueAmount . ' Fcfa.')
            // ->action('Paiement', url('/'))
            ->line('Merci de régler avant la date d\'échéance!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
