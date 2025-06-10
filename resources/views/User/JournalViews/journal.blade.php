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
  <body>
    <header>
      <a href="{{ route('views.Homepage') }}">
        <img class="logo" src="{{ asset('images/logo.png') }}" alt="logo">
      </a>
      <nav>
        <ul class="nav_links">
          <li><a style="color:#FFDB99" href="{{ route('views.journal') }}">Journal</a></li>
          <li><a href="#">Appointment</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Chat</a></li>
        </ul>
      </nav>
      <img style="width:50px; margin-left:15px;" src="{{ asset('images/profile.png') }}" alt="profile">
    </header>
    
    <div class="container">
      <h1>Journal</h1>

      <form method="GET" action="{{ route('views.journal') }}" class="search-bar">
        <input type="text" name="search" placeholder="Search your journal..." value="{{ request('search') }}">
        <button type="submit">Search</button>
      </form>

      @if($journals->isEmpty() && request('search'))
        <script>
          alert("No journal entries found for '{{ request('search') }}'.");
        </script>
      @endif

      @foreach ($journals as $index => $journal)
        <div class="journal-card">
          <div class="journal-card-header">
            <h2>{{ $journal->title }}</h2>
            <div class="user-icon">
              <img src="{{ asset('images/profile.png') }}" alt="User Icon">
            </div>
          </div>

          <p>{{ Str::limit($journal->journal_text, 200) }}</p>

          <div class="journal-footer">
            <div class="journal-date">
              {{ \Carbon\Carbon::parse($journal->date)->format('d M Y') }}
            </div>
            <div class="journal-actions">
              <a href="{{ route('journal.edit', $journal->id) }}" class="edit-btn">Edit</a>
              <form action="{{ route('journal.destroy', $journal->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">Delete</button>
              </form>
            </div>
          </div>
        </div>
      @endforeach

      <a href="{{ route('User.create') }}" class="floating-plus-btn">+</a>
    </div>
  </body>
</html>