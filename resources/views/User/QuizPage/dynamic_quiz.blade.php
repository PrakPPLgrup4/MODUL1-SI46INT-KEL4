<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ $quiz->title }} Test</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/User/quiz.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet" />
  </head>
  <body>
    <header>
      <a href="{{ route('views.Homepage') }}">
        <img class="logo" src="{{ asset('images/logo.png') }}" alt="logo" />
      </a>
      <nav>
        <ul class="nav_links">
          <li><a href="{{ route('views.journal') }}">Journal</a></li>
          <li><a href="#">Appointment</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Chat</a></li>
        </ul>
      </nav>
      <img class="profile-icon" src="{{ asset('images/profile.png') }}" alt="profile" />
    </header>

    <div class="container">
      <h1>{{ $quiz->title }} Test</h1>

      @if ($errors->any())
        <div class="error-messages" style="color:red; margin-bottom: 20px;">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('quiz.dynamic.submit', ['id' => $quiz->id]) }}" method="POST" id="quizForm">
        @csrf

        @foreach ($quiz->questions as $index => $question)
          <div class="quiz-card">
            <h2>{{ $index + 1 }}. {{ $question->question_text }}</h2>
            <label>
              <input
                type="radio"
                name="q{{ $index + 1 }}"
                value="1"
                {{ old('q' . ($index + 1)) === '1' ? 'checked' : '' }}
              />
              Yes
            </label>
            <label>
              <input
                type="radio"
                name="q{{ $index + 1 }}"
                value="0"
                {{ old('q' . ($index + 1)) === '0' ? 'checked' : '' }}
              />
              No
            </label>
          </div>
        @endforeach

        <button type="submit" class="submit-btn">Submit</button>
      </form>
    </div>

    @if (isset($score))
      @php
        // Customize your scoring logic and messages here
        if ($score >= 7) {
          $status = "You probably have " . strtolower($quiz->title) . "!";
          $description = "Your answers indicate a high level of " . strtolower($quiz->title) . ". Please consider seeking support from a mental health professional.";
          $image = strtolower($quiz->title) . "sad.png";
          $colorClass = "danger";
          $showFindMore = true;
        } elseif ($score >= 6) {
          $status = "You might have " . strtolower($quiz->title) . "!";
          $description = "Some signs of " . strtolower($quiz->title) . " are present. Monitor your well-being and consider talking to someone you trust.";
          $image = strtolower($quiz->title) . "concern.png";
          $colorClass = "warning";
          $showFindMore = true;
        } elseif ($score == 5) {
          $status = "Your result is neutral.";
          $description = "Your results are neutral. Maintain healthy habits and monitor your emotional health.";
          $image = strtolower($quiz->title) . "straight.png";
          $colorClass = "neutral";
          $showFindMore = true;
        } else {
          $status = "You don’t seem to have " . strtolower($quiz->title) . ".";
          $description = "You don’t show significant signs of " . strtolower($quiz->title) . ". Keep practicing self-care!";
          $image = strtolower($quiz->title) . "happy.png";
          $colorClass = "safe";
        }
      @endphp

      <div class="result-section">
        <h2>Done!</h2>
        <h3 class="{{ $colorClass }}">{{ $status }}</h3>
        <img src="{{ asset('images/' . $image) }}" alt="result-image" />
        <p>
          {{ $description }}
          @if ($showFindMore)
            <a href="{{ route('views.symptom') }}">Find more</a>
          @endif
        </p>
      </div>
    @endif

    <script>
      document.getElementById('quizForm').addEventListener('submit', function (e) {
        const totalQuestions = {{ $quiz->questions->count() }};
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
