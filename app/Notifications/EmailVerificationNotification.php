<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Mail\Mailable;

class EmailVerificationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(30),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->email)]
        );
    
        return (new MailMessage)
            ->subject('Confirma tu correo electrónico')
            ->line('Gracias por registrarte en nuestra aplicación. Por favor, confirma tu correo electrónico haciendo clic en el botón de abajo:')
            ->action('Confirmar correo electrónico', $verificationUrl)
            ->line('Si no has creado una cuenta en nuestra aplicación, simplemente ignora este correo electrónico.')
            ->salutation('¡Gracias!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
