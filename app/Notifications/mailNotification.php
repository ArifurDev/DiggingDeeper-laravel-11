<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class mailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $title;
    public $message;
    /**
     * Create a new notification instance.
     */
    public function __construct($notice)
    {
        $this->title = $notice['title'];
        $this->message = $notice['message'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $title = $this->title;
        $message = $this->message;

        // return (new MailMessage)
        //             ->line($title)
        //             ->line($message)
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');

        return (new MailMessage)->markdown('mailNotificatin',compact('title','message'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
