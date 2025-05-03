<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Our Psychiatrist</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/User/journal.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <style>
        .text-center {
            text-align: center;
            margin-top: 20px;
        }

        .psy-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px auto;
            padding: 20px;
            display: flex;
            align-items: center;
            width: 80%;
            transition: transform 0.3s;
        }

        .psy-card:hover {
            transform: translateY(-5px);
        }

        .psy-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
            border: 4px solid #4CAF50; /* Green border */
            padding: 2px;
            background-color: white; /* White background behind the border */
        }

        .psy-content {
            flex: 1;
        }

        .psy-content h4 {
            margin-bottom: 10px;
            font-size: 1.5em;
            color: #333;
        }

        .psy-content p {
            margin-bottom: 8px;
            color: #666;
        }

        .rating-text {
            margin-top: 10px;
        }

        .star {
            color: gold;
            font-size: 20px;
        }

        .text-muted {
            color: #999;
        }

        body {
            background-color: #f9f9f9;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>

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
