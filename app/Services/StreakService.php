<?php
// app/Services/StreakService.php

namespace App\Services;

use App\Models\User;
use App\Models\StreakLog;
use Carbon\Carbon;
use App\Events\StreakMilestoneReached;

class StreakService
{
    /**
     * Record user activity and update streaks
     */
    public function recordActivity(User $user, string $activityType): void
    {
        $today = Carbon::today();
        $field = "last_{$activityType}_date";
        $streakField = "{$activityType}_streak";

        // Check if already recorded today
        if ($user->$field && Carbon::parse($user->$field)->isToday()) {
            return;
        }

        // Record the activity
        StreakLog::create([
            'user_id' => $user->id,
            'activity_date' => $today,
            'activity_type' => $activityType
        ]);

        // Update streak
        $this->updateStreak($user, $activityType, $today);
    }

    /**
     * Update the streak counter for an activity type
     */
    protected function updateStreak(User $user, string $activityType, Carbon $today): void
    {
        $field = "last_{$activityType}_date";
        $streakField = "{$activityType}_streak";
        $yesterday = $today->copy()->subDay();

        if ($user->$field && Carbon::parse($user->$field)->equalTo($yesterday)) {
            $user->$streakField++;
        } else {
            $user->$streakField = 1;
        }

        $user->$field = $today;
        $user->save();

        // Check for milestones
        $this->checkMilestones($user, $activityType, $user->$streakField);
    }

    /**
     * Check if user reached any streak milestones
     */
    protected function checkMilestones(User $user, string $type, int $streak): void
    {
        $milestones = [3, 7, 14, 30, 60, 90];

        if (in_array($streak, $milestones)) {
            event(new StreakMilestoneReached(
                $user,
                $type,
                $streak
            ));
        }
    }

    /**
     * Get monthly activity for a specific type
     */
    public function getMonthlyActivity(User $user, string $type): array
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        return $user->streakLogs()
            ->where('activity_type', $type)
            ->whereBetween('activity_date', [$start, $end])
            ->pluck('activity_date')
            ->map(function ($date) {
                return Carbon::parse($date)->format('Y-m-d');
            })
            ->toArray();
    }
}