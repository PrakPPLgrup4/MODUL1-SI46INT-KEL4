<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/User/journal.css') }}">
<<<<<<< HEAD
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>
=======
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Poppins', sans-serif;
        }
        .text-center { text-align: center; margin-top: 20px; }

        .psy-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            padding: 20px;
            display: flex;
            align-items: center;
            width: 80%;
            transition: transform 0.3s;
            cursor: pointer;
        }
        .psy-card:hover { transform: translateY(-5px); }

        .psy-image {
            width: 120px; height: 120px; border-radius: 50%;
            object-fit: cover; margin-right: 20px;
            border: 4px solid #4CAF50; padding: 2px;
            background-color: white;
        }

        .psy-content { flex: 1; }
        .psy-content h4 { font-size: 1.5em; color: #333; margin-bottom: 10px; }
        .psy-content p { color: #666; margin-bottom: 8px; }

        .rating-text {
            margin-top: 10px;
        }

        .star { color: gold; font-size: 20px; }
        .text-muted { color: #999; }

        /* Modal Styles */
        .modal {
            display: none; position: fixed; z-index: 1;
            left: 0; top: 0; width: 100%; height: 100%;
            overflow: auto; background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 800px;
            border-radius: 10px;
        }

        .close {
            color: #aaa; float: right;
            font-size: 28px; font-weight: bold;
        }
        .close:hover, .close:focus { color: black; cursor: pointer; }

        .modal-body { display: flex; align-items: center; }
        .modal-body .psy-image { margin-right: 20px; }
        .modal-body .psy-details { flex: 1; }

        .rating-form {
            margin-top: 20px;
        }
        .rating-form select {
            padding: 5px 10px;
            font-size: 16px;
        }
        .rating-form button {
            padding: 6px 12px;
            margin-left: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
        }

        /* Success Popup */
        #successPopup {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: green;
            color: white;
            padding: 10px;
            border-radius: 5px;
            display: none;
            z-index: 1000;
        }
        .psy-buttons {
                margin-top: 10px;
            }

            .psy-buttons button {
                padding: 6px 12px;
                margin-right: 10px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-weight: bold;
                transition: background-color 0.2s ease;
            }

            .psy-buttons button:hover {
                background-color: #45a049;
            }
    </style>
</head>
<body>

>>>>>>> main
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

                
                <div class="psy-buttons">
                    <a href="{{ route('review.form') }}">
                        <button onclick="event.stopPropagation();">Review</button>
                    </a>
                    <a href="{{ route('review.index') }}">
                        <button onclick="event.stopPropagation();">View Reviews</button>
                    </a>
                </div>
                
            </div>
        </div>
    @endforeach

    <!-- @foreach($psychs as $psych)
        <div class="psy-card" onclick="openModal({{ $psych->id }}, '{{ $psych->full_name }}', '{{ $psych->description }}', '{{ asset('storage/' . $psych->picture) }}', {{ $psych->average_rating }})">
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
<<<<<<< HEAD
    @endforeach

=======
    @endforeach -->
>>>>>>> main
</div>

</body>
</html>
