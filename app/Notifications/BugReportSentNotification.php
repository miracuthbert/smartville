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
     * Holds the bug details
     *
     * @var $bug
     */
    protected $bug;

    /**
     * Holds feature details
     *
     * @var $feature
     */
    protected $feature;

    /**
     * Holds details of user who reported the bug
     *
     * @var $from
     */
    protected $from;

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
     * Holds bug details route
     *
     * @var $route
     */
    protected $route;

    /**
     * Holds notification subject
     *
     * @var string $subject
     */
    protected $subject;

    /**
     * Holds the notification greeting
     *
     * @var string $greeting
     */
    protected $greeting;

    /**
     * Create a new notification instance.
     *
     * @param $bug
     * @param $feature
     * @param $from
     * @param $user
     * @param $route
     */
    public function __construct($bug, $feature, $from, $user, $route)
    {
        $this->bug = $bug;

        $this->feature = $feature;

        $this->from = $from;

        $this->user = $user;

        $this->route = $route;

        $this->subject = str_limit('Bug reported for ' . $this->feature->feature);

        $this->greeting = 'Hello ' . $user->firstname . ',';

        $this->message = "A user has raised an issue on " . $this->bug->title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database, mail'];
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
            ->line('For more info click link below . ')
            ->action('View Report', $this->route)
            ->line('Thank you for using ' . config('app . name') . '!');
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
