@extends('admin.index')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Admin/quiz-edit.css') }}">
<h1 class="mb-4">Edit Quiz</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.quiz.update', $quiz->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label">Quiz Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $quiz->title) }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Quiz Description</label>
        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $quiz->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Quiz Image (optional)</label>
        @if($quiz->image)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $quiz->image) }}" alt="Quiz Image" width="150">
            </div>
        @endif
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
    </div>

    <h5>Questions (10)</h5>
    @foreach ($quiz->questions as $index => $question)
        <div class="mb-3">
            <label for="question_{{ $index }}" class="form-label">Question {{ $index + 1 }}</label>
            <input type="text" name="questions[]" id="question_{{ $index }}" class="form-control" value="{{ old('questions.' . $index, $question->question_text) }}" required>
        </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Update Quiz</button>
    <a href="{{ route('admin.quiz.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
