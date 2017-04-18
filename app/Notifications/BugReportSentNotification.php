<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BugReportSentNotification extends Notification
{
    use Queueable;

    /**
     * @var $bug
     */
    protected $bug;

    /**
     * @var $feature
     */
    protected $feature;

    /**
     * @var $user
     */
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($bug, $feature, $user)
    {
        $this->bug = $bug;
        $this->feature = $feature;
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
        return ['database'];
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', 'https://laravel.com')
            ->line('Thank you for using our application!');
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
            'title' => $this->bug->title,
            'name' => $this->user->firstname . ' ' . $this->user->lastname,
            'type' => 'bug',
            'id' => $this->bug->id,
        ];
    }
}
