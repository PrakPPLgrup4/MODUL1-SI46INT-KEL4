<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Journal</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/User/journal.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>

    <style>
        body{
            margin: 0;
        }

        .test_container{
            margin: 50px 70px;
            display: flex;
            flex-wrap: wrap;
            gap: 100px;
            padding-left: 50px;
        }

        .test_image{
            background-color: #ffffff;
            width: 350px;
            height: 500px;
            border-radius: 40px;
            box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.1);
        }

        .test_image img{
            width: 350px;
            height: 200px;
            border-radius: 40px;
            object-fit: cover;
        }



        .test_content h3{
            font-size: 22px;
            font-weight: 600;
            color: #000000;
            padding: 10px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .test_content p{
            height:130px;
            font-size: 18px;
            font-weight: 400;
            color: #000000;
            padding: 10px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .test_image a{
            padding: 8px 25px;
            margin-top: 20px;  
            background-color: #8DB600;
            border: 2px solid #8DB600;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease 0%;
            display: inline-block;
            margin-left: 20px;
            color: white;
            text-decoration: none;
        }

        h1{
            margin-left: 70px;
            margin-top: 50px;
        }

    </style>
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
      <img style="width:50px; margin-left:15px;" src="{{ asset('images/profile.png') }}" alt="profile">
    </header>

    <h1 class="test_text">All Quizzes</h1>

<div class="test_container">
    @foreach ($quizzes as $quiz)
        <div class="test_image">
            @if ($quiz->image)
                <img src="{{ asset($quiz->image) }}" alt="{{ $quiz->title }}">
            @else
                <img src="{{ asset('images/default-quiz.png') }}" alt="Default Quiz Image">
            @endif
            <div class="test_content">
                <h3>{{ $quiz->title }}</h3>
                <p>{{ Str::limit($quiz->description, 100) }}</p>

                {{-- 
                  For default quizzes, route to the default quiz view in QuizViews folder.
                  For new quizzes, you can route to a dynamic quiz page (if implemented).
                --}}

                @php
                    // List of default quizzes by their type names (matching your existing show method)
                    $defaultTypes = ['stress', 'anxiety', 'depression'];
                    $quizType = strtolower($quiz->title);
                @endphp

                @if (in_array($quizType, $defaultTypes))
                    <a href="{{ route('quiz.show', ['type' => $quizType]) }}">Take Quiz</a>
                @else
                    {{-- For newly added quizzes, route to a dynamic quiz page (implement if needed) --}}
                    <a href="{{ route('quiz.dynamic.show', ['id' => $quiz->id]) }}">Take Quiz</a>
                @endif
            </div>
        </div>
    @endforeach
</div>