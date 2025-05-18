<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Our Psychiatrist</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/User/journal.css') }}">
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
    @endforeach
</div>

<!-- The Modal -->
<div id="psyModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-body">
            <img id="psyImage" src="" alt="" class="psy-image" style="width: 150px; height: 150px; border-radius: 50%; border: 4px solid #4CAF50;">
            <div class="psy-details">
                <h2 id="psyName"></h2>
                <p id="psyDescription"></p>
                <p class="rating-text">
                    <strong>Rating:</strong> <span id="psyRating"></span>
                </p>

                <form id="ratingForm" class="rating-form" method="POST" action="{{ route('psych.rate') }}">
                    @csrf
                    <input type="hidden" name="psych_id" id="ratingPsychId">
                    <label for="rating">Rate this Psychiatrist:</label>
                    <select name="rating" required>
                        <option value="">Select</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Success Popup -->
<div id="successPopup">Rating submitted successfully!</div>

<script>
    function openModal(id, name, description, image, rating) {
        document.getElementById("psyModal").style.display = "block";
        document.getElementById("psyName").innerText = name;
        document.getElementById("psyDescription").innerText = description;
        document.getElementById("psyImage").src = image;
        document.getElementById("ratingPsychId").value = id;

        let fullStars = Math.floor(rating);
        let halfStar = (rating - fullStars >= 0.5);
        let stars = "";
        for (let i = 0; i < fullStars; i++) {
            stars += "★";
        }
        if (halfStar) {
            stars += "☆";
        }
        document.getElementById("psyRating").innerHTML = stars + " (" + rating.toFixed(1) + ")";
    }

    function closeModal() {
        document.getElementById("psyModal").style.display = "none";
    }

    // Show success popup after rating submission
    function showSuccessPopup() {
        var successPopup = document.getElementById('successPopup');
        successPopup.style.display = 'block';

        // Hide the popup after 5 seconds
        setTimeout(function() {
            successPopup.style.display = 'none';
        }, 5000);
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById("psyModal")) {
            closeModal();
        }
    }

    // Handle the form submission with AJAX to avoid page reload
    document.getElementById('ratingForm').onsubmit = function(event) {
        event.preventDefault();

        var form = new FormData(this);
        fetch('{{ route('psych.rate') }}', {
            method: 'POST',
            body: form,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccessPopup();  // Show success message
                closeModal();  // Close the modal after rating submission
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    };
</script>

</body>
</html>
