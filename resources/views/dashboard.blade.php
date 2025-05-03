<!-- resources/views/dashboard.blade.php -->
<div class="streak-section">
    <h2>Your Activity Streaks</h2>
    
    <div class="streak-container">
        <x-streak-display 
            type="login" 
            :streak="$user->login_streak" />
            
        <x-streak-display 
            type="journal" 
            :streak="$user->journal_streak" 
            :days="$journalDays" />
            
        <x-streak-display 
            type="mood" 
            :streak="$user->mood_streak" 
            :days="$moodDays" />
    </div>
    
    <div class="streak-actions">
        <button class="btn btn-primary record-journal">
            Record Journal Entry
        </button>
        <button class="btn btn-primary record-mood">
            Record Mood Check
        </button>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/streak.js') }}"></script>
@endpush