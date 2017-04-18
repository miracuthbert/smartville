<?php

namespace App\Notifications\Company;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CompanyAppCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Used to hold app details
     *
     * @var $app
     */
    protected $app;

    /**
     * Used to hold app company details
     *
     * @var $company
     */
    protected $company;

    /**
     * Used to hold app product details
     *
     * @var $product
     */
    protected $product;

    /**
     * Used to hold welcome message details
     *
     * @var
     */
    protected $message;

    /**
     * Used to hold app dashboard route
     *
     * @var $appRoute
     */
    protected $appRoute;

    /**
     * Used to hold notification greeting
     *
     * @var $greeting
     */
    protected $greeting;

    /**
     * Create a new notification instance.
     *
     * @param $app
     * @param $company
     * @param $product
     * @param $message
     * @param $route
     */
    public function __construct($app, $company, $product, $message, $route)
    {
        $this->app = $app;

        $this->company = $company;

        $this->product = $product;

        $this->message = $message;

        $this->appRoute = $route;

        $this->greeting = 'Hello and congratulations!';
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
            ->subject('New Application Created')
            ->greeting($this->greeting)
            ->line($this->message)
            ->action('Go to Dashboard', route($this->appRoute, ['id' => $this->app->id]))
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
            'greeting' => $this->greeting,
            'app_id' => $this->app->id,
            'app_route' => $this->appRoute,
            'type' => 'estate',
        ];
    }
}
