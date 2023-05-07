<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCourseNotification extends Notification
{
    use Queueable;

    public $course_id;
    public $course_name;

    /**
     * Create a new notification instance.
     */
    public function __construct($course_id, $course_name)
    {
        $this->course_id = $course_id;
        $this->course_name = $course_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'course_id' => $this->course_id,
            'course_name' => $this->course_name,
            'message' => 'You have been Added to a New Course ' . '(' . $this->course_id . ': ' . $this->course_name . ')',
            'redirect' => 'courses.show',
            'argument' => $this->course_id
        ];
    }
}
