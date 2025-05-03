<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    @props(['type', 'streak', 'days' => []])

@php
    $titles = [
        'login' => 'Login Streak',
        'journal' => 'Journaling Streak',
        'mood' => 'Mood Check Streak'
    ];
    
    $icons = [
        'login' => '🔑',
        'journal' => '📔',
        'mood' => '😊'
    ];
@endphp

<div class="streak-card">
    <div class="streak-header">
        <span class="streak-icon">{{ $icons[$type] }}</span>
        <h3>{{ $titles[$type] }}</h3>
    </div>
    <div class="streak-count">
        {{ $streak }} days
    </div>
    @if($type !== 'login')
        <div class="streak-calendar">
            @for($i = 1; $i <= 30; $i++)
                @php
                    $date = now()->startOfMonth()->addDays($i - 1);
                    $isActive = in_array($date->format('Y-m-d'), $days);
                @endphp
                <div class="calendar-day {{ $isActive ? 'active' : '' }}" 
                     title="{{ $date->format('M j') }}">
                    {{ $i }}
                </div>
            @endfor
        </div>
    @endif
</div> 
</div>