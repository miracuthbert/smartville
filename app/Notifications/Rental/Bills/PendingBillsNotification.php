<?php

namespace App\Notifications\Rental\Bills;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PendingBillsNotification extends Notification
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
     * Holds the total pending bills
     *
     * @var $bill
     */
    public $total;

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
     * Holds notification bill time
     *
     * @var bool $is_today
     */
    protected $is_today;

    /**
     * Create a new notification instance.
     *
     * @param $app
     * @param $bill
     * @param $total
     * @param $today
     */
    public function __construct($app, $bill, $total, $today)
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

        //total bills
        $this->total = $total;

        //subject
        $this->subject = title_case($this->bill->title) . ' Pending Bills Reminder';

        //greeting
        $this->greeting = 'Hello,';

        //date
        $this->is_today = $today;

        if ($today === 0)//past message
            $this->message = 'There are (' . $total . ') ' . $this->bill->title . ' bills that are past due.';
        else//current message
            $this->message = 'There are (' . $total . ') ' . $this->bill->title . ' bills that are due today.';

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
            'is_today' => $this->is_today,
            'type' => 'pending_bills_invoices',
        ];
    }
}
