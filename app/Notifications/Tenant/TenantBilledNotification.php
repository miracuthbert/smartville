<?php

namespace App\Notifications\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TenantBilledNotification extends Notification
{
    use Queueable;

    /**
     * @var $invoice
     */
    protected $invoice;

    /**
     * @var $bill
     */
    protected $bill;


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
     *
     * @param $invoice
     * @param $bill
     * @param $company
     */
    public function __construct($invoice, $bill, $company)
    {
        $this->invoice = $invoice;

        $this->bill = $bill;

        $this->company = $company;

        $this->subject = 'Invoice for ' . $this->bill->title . ' Bill';

        $this->message = $company->title . " has sent you an invoice for rental of property " . $this->property->title . " from " . MonthName($invoice->date_from) . " to " . MonthName($invoice->date_to) . ". Payment is due by " . $invoice->date_due->toDateString() . ".";
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
//        $user = $notifiable->

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
        //amount
        $amount = $this->bill->unit_cost;

        //previous usage
        $prev = $this->bill->previous_usage;

        //current usage
        $curr = $this->bill->current_usage;

        //total amount
        $total = $this->bill->bill_plan == 0 ? $amount : ($amount * ($curr - $prev));

        return [
            'title' => $this->subject,
            'message' => $this->message,
            'from' => $this->company->title,
            'type' => 'tenant_bill_invoice',
            'invoice_id' => $this->invoice->id,
            'invoice_due' => $this->invoice->date_due->toDateString(),
            'amount' => $total,
            'company_app_id' => $this->bill->app->id,
        ];
    }
}
