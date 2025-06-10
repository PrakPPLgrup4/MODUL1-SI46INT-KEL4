<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Journal</title>
  <link rel="stylesheet" href="{{ asset('css/User/journal.css') }}">
</head>
<body>
  <div class="form-container">
    <h1>Edit Journal Entry</h1>

    @if ($errors->any())
      <div class="error">
        <ul>
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('journal.update', $journal->id) }}" method="POST">
      @csrf
      @method('PUT')
      <label>Title</label>
      <input type="text" name="title" value="{{ $journal->title }}" required>

      <label>Date</label>
      <input type="date" name="date" value="{{ $journal->date }}" required>

      <label>Journal Text</label>
      <textarea name="journal_text" rows="5" required>{{ $journal->journal_text }}</textarea>

      <div class="form-buttons">
        <button class="submit" type="submit">Update</button>
        <button type="button" class="cancel-btn" onclick="window.location='{{ route('views.journal') }}'">Cancel</button>
    </form>
  </div>
</body>
</html>
