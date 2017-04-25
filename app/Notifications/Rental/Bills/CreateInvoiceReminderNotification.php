<?php

namespace App\Notifications\Rental\Bills;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CreateInvoiceReminderNotification extends Notification
{
    use Queueable;

    /**
     * Holds the app details
     *
     * @var $app
     */
    public $app;

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
     * Holds the bill details
     *
     * @var $bill
     */
    public $bill;

    /**
     * Holds the notification greeting
     *
     * @var string $greeting
     */
    protected $greeting;

    /**
     * Holds the notification message
     *
     * @var string $message
     */
    protected $message;

    /**
     * Holds the app route
     *
     * @var $appRoute
     */
    protected $appRoute;

    /**
     * Holds notification subject
     *
     * @var string $subject
     */
    protected $subject;

    /**
     * Create a new notification instance.
     *
     * @param $app
     * @param $bill
     */
    public function __construct($app, $bill)
    {
        //app
        $this->app = $app;

        //app product
        $this->product = $app->product;

        //app company
        $this->company = $app->company;

        //app dash route
        $this->appRoute = AppDashRoute($this->product->title);

        //billing service
        $this->bill = $bill;

        //subject
        $this->subject = title_case($this->bill->title) . ' Billing Reminder';

        //greeting
        $this->greeting = 'Hello,';

        //message
        $this->message = 'You scheduled today for creating ' . $this->bill->title . ' bill invoices.';

        //delay notification
        $this->delay = Carbon::now()->addSeconds(10);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'/*, 'mail'*/];
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
            ->action('Go to App', route($this->appRoute, ['id' => $this->app->id]))
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
            'billing_id' => $this->bill->id,
            'title' => $this->subject,
            'message' => $this->message,
            'type' => 'create_bill_invoices',
        ];
    }
}
