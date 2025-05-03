// resources/js/streak.js
document.addEventListener('DOMContentLoaded', function() {
    // Record journal entry
    document.querySelectorAll('.record-journal').forEach(button => {
        button.addEventListener('click', function() {
            axios.post('/streak/journal')
                .then(response => {
                    updateStreakDisplay();
                    showToast('Journal entry recorded!');
                });
        });
    });
    
    // Record mood check
    document.querySelectorAll('.record-mood').forEach(button => {
        button.addEventListener('click', function() {
            axios.post('/streak/mood')
                .then(response => {
                    updateStreakDisplay();
                    showToast('Mood check recorded!');
                });
        });
    });
    
    // Update streak display every minute
    updateStreakDisplay();
    setInterval(updateStreakDisplay, 60000);
    
    function updateStreakDisplay() {
        axios.get('/streak/data')
            .then(response => {
                // Update streak numbers
                document.querySelectorAll('.login-streak').forEach(el => {
                    el.textContent = response.data.login_streak;
                });
                document.querySelectorAll('.journal-streak').forEach(el => {
                    el.textContent = response.data.journal_streak;
                });
                document.querySelectorAll('.mood-streak').forEach(el => {
                    el.textContent = response.data.mood_streak;
                });
                
                // Update calendar highlights
                updateCalendar('journal', response.data.journal_days);
                updateCalendar('mood', response.data.mood_days);
            });
    }
    
    function updateCalendar(type, activeDays) {
        const calendar = document.querySelector(`.${type}-calendar`);
        if (calendar) {
            const days = calendar.querySelectorAll('.calendar-day');
            days.forEach(day => {
                const dayNumber = parseInt(day.textContent);
                const date = new Date();
                date.setDate(dayNumber);
                const dateStr = formatDate(date);
                
                if (activeDays.includes(dateStr)) {
                    day.classList.add('active');
                } else {
                    day.classList.remove('active');
                }
            });
        }
    }
    
    function formatDate(date) {
        return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;
    }
    
    function showToast(message) {
        // Implement your toast notification here
        console.log(message);
    }
});