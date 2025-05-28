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
  <title>Star Rating Review</title>
  <style>
    
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      padding: 20px;
    }

    .review-section {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .star-rating {
      display: flex;
      flex-direction: row-reverse;
      justify-content: flex-end;
      font-size: 2rem;
      gap: 5px;
      cursor: pointer;
    }

    .star-rating input {
      display: none;
    }

    .star-rating label {
      color: #ccc;
      transition: color 0.2s;
    }

    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
      color: gold;
    }

    textarea {
      width: 100%;
      margin-top: 16px;
      padding: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    button {
      margin-top: 12px;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
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
<div class="review-section">
  <h2>Leave a Review</h2>

  {{-- Success message --}}
  @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
  @endif

  <form id="reviewForm" action="{{ route('review.store') }}" method="POST">
    @csrf

    <!-- Star Rating -->
    <div class="star-rating">
      <input type="radio" id="star5" name="rating" value="5"><label for="star5">★</label>
      <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
      <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
      <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
      <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
    </div>

    <!-- Name Text -->
    <textarea name="name" rows="1" placeholder="Your name..." required></textarea>

    <!-- Review Text -->
    <textarea name="review" rows="4" placeholder="Write your review..." required></textarea>

    <!-- Submit -->
    <button type="submit">Submit Review</button>
  </form>
</div>

</body>
</html>
