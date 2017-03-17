<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EstateBillingReminder extends Notification
{
    use Queueable;

    /**
     * @var $estate
     */
    public $estate;

    /**
     * @var $billing
     */
    public $billing;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($estate, $billing)
    {
        $this->estate = $estate;

        $this->billing = $billing;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
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
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => $this->billing->title,
            'message' => 'You have a scheduled billing to do today.',
            'type' => 'estate_billing',
            'id' => $this->billing->id,
        ];
    }
}
