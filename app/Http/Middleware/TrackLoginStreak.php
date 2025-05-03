<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Services\StreakService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackLoginStreak
{
    protected $streakService;
    public function __construct(StreakService $streakService)
    {
        $this->streakService = $streakService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $this->streakService->recordActivity(Auth::user(), 'login');
        }
        
        return $next($request);
    }
}
