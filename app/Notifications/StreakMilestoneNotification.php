<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StreakMilestoneNotification extends Notification
{
    use Queueable;
    public $activityType;
    public $streak;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $activityType, int $streak)
    {
        $this->activityType = $activityType;
        $this->streak = $streak;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
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
    public function toArray($notifiable)
    {
        $activityNames = [
            'login' => 'Login',
            'journal' => 'Journal Entry',
            'mood' => 'Mood Check'
        ];
        
        return [
            'message' => "🎉 {$activityNames[$this->activityType]} Streak! You've reached {$this->streak} days!",
            'link' => '/dashboard',
            'type' => 'streak_milestone'
        ];
    }
}
