<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Depression Test</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/User/quiz.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
  </head>
  <body>
    <header>
      <a href="{{ route('views.Homepage') }}">
        <img class="logo" src="{{ asset('images/logo.png') }}" alt="logo">
      </a>
      <nav>
        <ul class="nav_links">
          <li><a href="{{ route('views.journal') }}">Journal</a></li>
          <li><a href="#">Appointment</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Chat</a></li>
        </ul>
      </nav>
      <img class="profile-icon" src="{{ asset('images/profile.png') }}" alt="profile">
    </header>
    <div class="container">
      <h1>Depression Test</h1>

      @if ($errors->any())
        <div class="error-messages" style="color:red; margin-bottom: 20px;">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('quiz.submit', ['type' => 'depression']) }}" method="POST" id="quizForm">
        @csrf

        <div class="quiz-card">
          <h2>1. Do you often feel sad for no reason?</h2>
          <label><input type="radio" name="q1" value="1" {{ old('q1') === '1' ? 'checked' : '' }}> Yes</label>
          <label><input type="radio" name="q1" value="0" {{ old('q1') === '0' ? 'checked' : '' }}> No</label>
        </div>
        <div class="quiz-card">
          <h2>2. Have you lost interest or pleasure in activities you usually enjoy?</h2>
          <label><input type="radio" name="q2" value="1" {{ old('q2') === '1' ? 'checked' : '' }}> Yes</label>
          <label><input type="radio" name="q2" value="0" {{ old('q2') === '0' ? 'checked' : '' }}> No</label>
        </div>
        <div class="quiz-card">
          <h2>3. Do you feel tired almost all the time, even when not doing much?</h2>
          <label><input type="radio" name="q3" value="1" {{ old('q3') === '1' ? 'checked' : '' }}> Yes</label>
          <label><input type="radio" name="q3" value="0" {{ old('q3') === '0' ? 'checked' : '' }}> No</label>
        </div>
        <div class="quiz-card">
          <h2>4. Do you feel worthless or guilty without a clear reason?</h2>
          <label><input type="radio" name="q4" value="1" {{ old('q4') === '1' ? 'checked' : '' }}> Yes</label>
          <label><input type="radio" name="q4" value="0" {{ old('q4') === '0' ? 'checked' : '' }}> No</label>
        </div>
        <div class="quiz-card">
          <h2>5. Do you have trouble sleeping or sleep too much?</h2>
          <label><input type="radio" name="q5" value="1" {{ old('q5') === '1' ? 'checked' : '' }}> Yes</label>
          <label><input type="radio" name="q5" value="0" {{ old('q5') === '0' ? 'checked' : '' }}> No</label>
        </div>
        <div class="quiz-card">
          <h2>6. Do you have difficulty concentrating or making simple decisions?</h2>
          <label><input type="radio" name="q6" value="1" {{ old('q6') === '1' ? 'checked' : '' }}> Yes</label>
          <label><input type="radio" name="q6" value="0" {{ old('q6') === '0' ? 'checked' : '' }}> No</label>
        </div>
        <div class="quiz-card">
          <h2>7. Has your appetite decreased or increased drastically?</h2>
          <label><input type="radio" name="q7" value="1" {{ old('q7') === '1' ? 'checked' : '' }}> Yes</label>
          <label><input type="radio" name="q7" value="0" {{ old('q7') === '0' ? 'checked' : '' }}> No</label>
        </div>
        <div class="quiz-card">
          <h2>8. Do you feel slower in moving or speaking than usual?</h2>
          <label><input type="radio" name="q8" value="1" {{ old('q8') === '1' ? 'checked' : '' }}> Yes</label>
          <label><input type="radio" name="q8" value="0" {{ old('q8') === '0' ? 'checked' : '' }}> No</label>
        </div>
        <div class="quiz-card">
          <h2>9. Do you feel life is hopeless or that there is no bright future?</h2>
          <label><input type="radio" name="q9" value="1" {{ old('q9') === '1' ? 'checked' : '' }}> Yes</label>
          <label><input type="radio" name="q9" value="0" {{ old('q9') === '0' ? 'checked' : '' }}> No</label>
        </div>
        <div class="quiz-card">
          <h2>10. Have you ever had thoughts of harming yourself or felt better off not living?</h2>
          <label><input type="radio" name="q10" value="1" {{ old('q10') === '1' ? 'checked' : '' }}> Yes</label>
          <label><input type="radio" name="q10" value="0" {{ old('q10') === '0' ? 'checked' : '' }}> No</label>
        </div>
        <button type="submit" class="submit-btn">Submit</button>
      </form>
    </div>

    @if (isset($score))
      @php
        if ($score >= 7) {
          $status = "You probably have depression!";
          $description = "Your answers indicate a high level of depression. Please consider seeking support from a mental health professional.";
          $image = "sad.png";
          $colorClass = "danger";
          $showFindMore = true;
        } elseif ($score == 6) {
          $status = "You might have depression!";
          $description = "Some signs of depression are present. Monitor your well-being and consider talking to someone you trust.";
          $image = "concern.png";
          $colorClass = "warning";
          $showFindMore = true;
        } elseif ($score == 5) {
          $status = "Your result is neutral.";
          $description = "Your results are neutral. Maintain healthy habits and monitor your emotional health.";
          $image = "straight.png";
          $colorClass = "neutral";
          $showFindMore = true;
        } else {
          $status = "You don’t seem to have depression.";
          $description = "You don’t show significant signs of depression. Keep practicing self-care!";
          $image = "happy.png";
          $colorClass = "safe";
        }
      @endphp

      <div class="result-section">
        <h2>Done!</h2>
        <h3 class="{{ $colorClass }}">{{ $status }}</h3>
        
        <img src="{{ asset('images/' . $image) }}" alt="result-image">
        <p>
          {{ $description }}
          @if ($showFindMore)
            <a href="{{ route('views.symptom') }}">Find more</a>
          @endif
        </p>
      </div>
    @endif

    <script>
      document.getElementById('quizForm').addEventListener('submit', function(e) {
        const totalQuestions = 10;
        let unanswered = [];
        for (let i = 1; i <= totalQuestions; i++) {
          const options = document.getElementsByName('q' + i);
          let answered = false;
          for (const option of options) {
            if (option.checked) {
              answered = true;
              break;
            }
          }
          if (!answered) {
            unanswered.push(i);
          }
        }
        if (unanswered.length > 0) {
          e.preventDefault();
          alert('Please answer all questions. Unanswered questions: ' + unanswered.join(', '));
        }
      });
    </script>
  </body>
</html>
