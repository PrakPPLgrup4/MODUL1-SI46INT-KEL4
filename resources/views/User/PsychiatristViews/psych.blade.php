<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/User/journal.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>
<header>
    <img class="logo" src="{{ asset('images/logo.png') }}" alt="logo">
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

<div class="container mt-5">
    <h2 class="text-center mb-5">Our Psychiatrist</h2>

    @foreach($psychs as $psych)
        <div class="psy-card">
            <img src="{{ asset('storage/' . $psych->picture) }}" alt="{{ $psych->full_name }}" class="psy-image">
            <div class="psy-content">
                <h4>{{ $psych->full_name }}</h4>
                <p>{{ $psych->description }}</p>
                <p class="rating-text">
                    <strong>Rating:</strong>
                    @php
                        $fullStars = floor($psych->average_rating);
                        $halfStar = ($psych->average_rating - $fullStars >= 0.5);
                    @endphp
                    @for($i = 0; $i < $fullStars; $i++)
                        <span class="star">★</span>
                    @endfor
                    @if($halfStar)
                        <span class="star">☆</span>
                    @endif
                    <span class="text-muted">({{ number_format($psych->average_rating, 1) }})</span>
                </p>
            </div>
        </div>
    @endforeach

</div>

</body>
</html>
