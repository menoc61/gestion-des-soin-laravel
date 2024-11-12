<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $newPassword;

    public function __construct($newPassword)
    {
        $this->newPassword = $newPassword;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Vos identifiants pour ')
            ->line('Votre mot de passe a été réinitialisé avec succès.')
            ->line('Votre nouveau mot de passe est: ' . $this->newPassword)
            ->action('Log In', route('login'))
            ->line('Si vous n\'avez pas demandé cette réinitialisation de mot de passe, veuillez ignorer cet e-mail.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
