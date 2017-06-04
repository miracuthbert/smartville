<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var $user
     */
    protected $user;

    /**
     * @var $message
     */
    protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Message Received')
            ->greeting('Hello ' . $this->user->firstname . ',')
            ->line('A new message has been left for you by ' . $this->message->name)
            ->action('Read it now!', route('admin.contact.message', ['id' => $this->message->id]))
            ->line(config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => $this->message->subject,
            'name' => $this->message->name,
            'type' => 'contact',
            'id' => $this->message->id,
            'role_id' => $this->user->root != null ? $this->user->root->role_id : null,
        ];
    }
}
