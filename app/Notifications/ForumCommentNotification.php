<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ForumCommentNotification extends Notification
{
    use Queueable;

    /**
     * @var $user
     */
    protected $user;

    /**
     * @var $forum
     */
    protected $forum;

    /**
     * @var $comment
     */
    protected $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($forum, $comment, $user)
    {
        $this->forum = $forum;
        $this->comment = $comment;
        $this->user = $user;
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
        return (new MailMessage)
            ->subject('New Comment Posted')
            ->greeting('Hello ' . $this->user->firstname . ',')
            ->line('A new comment has been left for posted on ' . $this->forum->title)
            ->action('Read it now!', route('forum.show', [
                'forum' => $this->forum->id,
                '#' => 'comment' . $this->comment->id
            ]))
            ->line(config('app.name'));
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
            'title' => $this->forum->title,
            'name' => $this->comment->user->firstname . ' ' . $this->comment->user->lastname,
            'type' => 'forum',
            'id' => $this->forum->id,
            'comment_id' => $this->comment->id,
        ];
    }
}
