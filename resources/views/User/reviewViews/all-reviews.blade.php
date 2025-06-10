<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>All Reviews</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="{{ asset('css/User/journal.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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

        .edit-button,
        .delete-button {
            margin-top: 10px;
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
        }

        .edit-button {
            background-color: #2196F3;
            color: white;
            border: none;
        }

        .edit-button:hover {
            background-color: #1976D2;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
            border: none;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #d32f2f;
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

            <br>

            <a href="{{ route('review.edit', $review->id) }}" class="edit-button">Edit</a>

            <form action="{{ route('review.destroy', $review->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button" onclick="return confirm('Delete this review?')">Delete</button>
            </form>
        </div>
    @endforeach

    @if($reviews->isEmpty())
        <p>No reviews yet. Be the first!</p>
    @endif

</body>
</html>
