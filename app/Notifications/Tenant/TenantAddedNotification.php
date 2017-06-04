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
     * Holds notification message
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
     * Holds notification subject
     *
     * @var string $subject
     */
    protected $subject;

    /**
     * Create a new notification instance.
     *
     * @param $lease
     * @param $app
     * @param $company
     * @param $user
     * @param $route
     */
    public function __construct($lease, $app, $company, $user, $route)
    {
        $this->lease = $lease;

        $this->app = $app;

        $this->company = $company;

        $this->user = $user;

        $this->message = "You have been added to " . $company->title . " as a tenant. Go to your dashboard to access this company's tenant panel; where you will find your lease details plus invoices and other details that will be sent by your landlord (property manager or host).";

        $this->userRoute = $route;

        $this->greeting = 'Hello and congratulations ' . $user->firstname . ',';

        $this->subject = 'Tenancy Activated';
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
            ->subject($this->subject)
            ->greeting($this->greeting)
            ->line($this->message)
            ->action('Go to your dashboard', $this->userRoute)
            ->line('Thank you for using ' . config('app.name') . '!');
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
            'tenant_id' => $this->lease->tenant->id,
            'title' => $this->subject,
            'message' => $this->message,
            'type' => 'activated_tenancy',
        ];
    }
}
