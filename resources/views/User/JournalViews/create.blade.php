<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Create Journal</title>
  <link rel="stylesheet" href="{{ asset('css/User/journal.css') }}">
</head>
<body>
  <div class="form-container">
    <h1>New Journal Entry</h1>

    @if ($errors->any())
      <div class="error">
        <ul>
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('journal.store') }}" method="POST">
      @csrf
      <label>Title</label>
      <input type="text" name="title" required>

      <label>Date</label>
      <input type="date" name="date" required>

      <label>Journal Text</label>
      <textarea name="journal_text" rows="5" required></textarea>

      <div class="form-buttons">
        <button class="submit" type="submit">Save</button>
        <button type="button" class="cancel-btn" onclick="window.location='{{ route('views.journal') }}'">Cancel</button>
      </div>
    </form>
  </div>
</body>
</html>
