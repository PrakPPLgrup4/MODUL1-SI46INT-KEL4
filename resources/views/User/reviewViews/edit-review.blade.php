<h2>Edit Your Review</h2>

<form action="{{ route('review.update', $review->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Rating (1–5):</label><br>
    <input type="number" name="rating" value="{{ old('rating', $review->rating) }}" min="1" max="5" required><br><br>

    <label>Review:</label><br>
    <textarea name="review" required>{{ old('review', $review->review) }}</textarea><br><br>

    <button type="submit">Update Review</button>
</form>