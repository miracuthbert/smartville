<?php

namespace App\Notifications\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RentInvoiceSentNotification extends Notification
{
    use Queueable;

    /**
     * Holds rent details
     *
     * @var $rent
     */
    protected $rent;

    /**
     * Holds rent property details
     *
     * @var $rent
     */
    protected $property;

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
    protected $route;

    /**
     * Holds notification subject
     *
     * @var string $subject
     */
    protected $subject;

    /**
     * Create a new notification instance.
     * @param $tenantRent
     * @param $app
     * @param $company
     * @param $user
     * @param $route
     */
    public function __construct($tenantRent, $app, $company, $user, $route)
    {
        $this->rent = $tenantRent;
        $this->property = $tenantRent->property;
        $this->app = $app;
        $this->company = $company;
        $this->user = $user;
        $this->route = $route;
        $this->subject = "Invoice for Property Rental";
        $this->message = $company->title . " has sent you an invoice for rental of property " . $this->property->title . " from " . MonthName($tenantRent->date_from) . " to " . MonthName($tenantRent->date_to) . ". Payment is due by " . $tenantRent->date_due->toDateString() . ".";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', /*'mail'*/];
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
            ->subject($this->subject)
            ->line($this->message)
            ->line('For more info click link below.')
            ->action('View Invoice', $this->route)
            ->line('Thank you for using ' . config('app.name') . '!');
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
            'rent_id' => $this->rent->id,
            'title' => $this->subject,
            'message' => $this->message,
            'type' => 'tenant_rent_invoice',
        ];
    }
}
