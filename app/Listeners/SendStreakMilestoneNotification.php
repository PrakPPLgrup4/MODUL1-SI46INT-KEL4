<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\StreakMilestoneReached;
use App\Notifications\StreakMilestoneNotification;

class SendStreakMilestoneNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StreakMilestoneReached $event)
    {
        $event->user->notify(new StreakMilestoneNotification(
            $event->activityType,
            $event->streak
        ));
    }
}
