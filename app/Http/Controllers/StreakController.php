<?php

namespace App\Http\Controllers;

use App\Services\StreakService;
use Illuminate\Http\Request;

class StreakController extends Controller
{
    protected $streakService;
    
    public function __construct(StreakService $streakService)
    {
        $this->streakService = $streakService;
    }
    
    public function recordJournalEntry(Request $request)
    {
        $this->streakService->recordActivity($request->user(), 'journal');
        return response()->json(['success' => true]);
    }
    
    public function recordMoodCheck(Request $request)
    {
        $this->streakService->recordActivity($request->user(), 'mood');
        return response()->json(['success' => true]);
    }
    
    public function getStreakData(Request $request)
    {
        $user = $request->user();
        $journalDays = $this->streakService->getMonthlyActivity($user, 'journal');
        $moodDays = $this->streakService->getMonthlyActivity($user, 'mood');
        
        return response()->json([
            'login_streak' => $user->login_streak,
            'journal_streak' => $user->journal_streak,
            'mood_streak' => $user->mood_streak,
            'journal_days' => $journalDays,
            'mood_days' => $moodDays
        ]);
    }
}
