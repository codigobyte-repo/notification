<?php

namespace App\Notifications;

use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Broadcast;

class MessageSent extends Notification implements ShouldQueue
{
    use Queueable;

    public $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        /* Recuperamos el usuario que escribió el correo */
        $sender = User::find($this->message->sender_id);

        return (new MailMessage)
                    ->from('no-reply@redis.com.ar', 'Sistema Redis')
                    ->subject($this->message->subject)
                    ->attach(public_path('images/Portada.png'), [
                        'as' => 'imagen.png',
                        'mime' => 'image/png'
                    ])
                    ->view('emails.message-sent', [
                        'sender' => $sender,
                        'body' => $this->message->body
                    ]);
                    /* ->greeting('Prueba de notificación')
                    ->line(" {$sender->name} te ha enviado un mensaje ")
                    ->line($this->message['body'])
                    ->action('Ver mensaje', url('/dashboard')); */
    }

    public function toDatabase(object $notifiable): array
    {

        $notifiable->notification +=1;
        $notifiable->save();

        $sender = User::find($this->message->sender_id);

        return [
            'url' => route('messages.show', $this->message),
            'message' => "Has recibido un nuevo mensaje de " . $sender->name,
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([]);
    }
}
