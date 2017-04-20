<?php

namespace App\Notifications\Company;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CompanyAppSubscriptionEndedNotification extends Notification
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
     * Holds app product details
     *
     * @var $company
     */
    protected $product;

    /**
     * Holds the passed subscription object
     *
     * @var $subscription
     */
    protected $subscription;

    /**
     * Holds the passed subscription type
     *
     * @var $type
     */
    protected $type;

    /**
     * Holds the notification greeting
     *
     * @var string $greeting
     */
    protected $greeting;

    /**
     * Holds the notification message
     *
     * @var string
     */
    protected $message;


    /**
     * Holds the app route
     * 
     * @var $appRoute
     */
    protected $appRoute;

    /**
     * Create a new notification instance.
     *
     * @param $app
     * @param $company
     * @param $subscription
     * @param $type
     */
    public function __construct($app, $company, $subscription, $type)
    {
        $this->app = $app;

        $this->product = $app->product;

        $this->appRoute = AppDashRoute($this->product);
        
        $this->company = $company;

        $this->subscription = $subscription;

        $this->type = $type;

        $this->greeting = 'Hello,';

        $this->message = 'Your subscription for ' . $this->product->title . ' ' . $company->title . ' has just ended.';
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
            ->subject('App Subscription Ended')
            ->greeting($this->greeting)
            ->line($this->message)
            ->action('Go to App Dashboard', route($this->appRoute, ['id' => $this->app->id]))
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
            'subscription_id' => $this->subscription->id,
            'subscription_type' => $this->type,
            'type' => 'subscription',
        ];
    }
}
