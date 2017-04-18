<?php

namespace App\Notifications\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TenantAddedNotification extends Notification
{
    use Queueable;

    /**
     * Holds lease details
     *
     * @var $lease
     */
    protected $lease;

    /**
     * Holds app details
     *
     * @var $app
     */
    protected $app;

    /**
     * Holds company details
     *
     * @var $company details
     */
    protected $company;

    /**
     * Holds user details
     *
     * @var $user
     */
    protected $user;

    /**
     * Holds user message
     * 
     * @var $message
     */
    protected $message;

    /**
     * Holds user route
     * 
     * @var $userRoute
     */
    protected $userRoute;

    /**
     * Create a new notification instance.
     *
     * @param $lease
     * @param $app
     * @param $company
     * @param $user
     * @param $message
     * @param $route
     */
    public function __construct($lease, $app, $company, $user, $message, $route)
    {
        $this->lease = $lease;

        $this->app = $app;

        $this->company = $company;

        $this->user = $user;

        $this->message = $message;

        $this->userRoute = $route;

        $this->greeting = 'Hello and congratulations ' . $user->firstname . ',';
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
            ->subject('Tenancy ')
            ->greeting($this->greeting)
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
            //
        ];
    }
}
