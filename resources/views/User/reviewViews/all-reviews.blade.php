<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Journal</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/User/journal.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>All Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 20px;
        }

        .review-box {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .review-box strong {
            color: #4CAF50;
        }

        .review-box small {
            color: #777;
        }
    </style>
</head>
<body>
    <header>
      <a href="{{ route('views.Homepage') }}">
        <img class="logo" src="{{ asset('images/logo.png') }}" alt="logo">
      </a>
      <nav>
        <ul class="nav_links">
          <li><a href="#">Journal</a></li>
          <li><a href="#">Appointment</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Chat</a></li>
        </ul>
      </nav>
      <img style="width:50px; margin-left:15px;" src="{{ asset('images/profile.png') }}" alt="profile">
    </header>
<h2>All Submitted Reviews</h2>

@foreach($reviews as $review)
    <div class="review-box">
        <strong>{{ $review->name }}</strong> rated {{ $review->rating }}/5<br>
        <p>{{ $review->review }}</p>
        <small>Posted on {{ $review->created_at->format('d M Y H:i') }}</small>
    </div>
@endforeach

@if($reviews->isEmpty())
    <p>No reviews yet. Be the first!</p>
@endif

</body>
</html>