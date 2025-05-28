@extends('admin.index')

@section('content')
<h1 class="mb-4">Add New Quiz</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.quiz.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Quiz Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Quiz Description</label>
        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Quiz Image (optional)</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
    </div>

    <h5>Questions (10)</h5>
    @for ($i = 0; $i < 10; $i++)
        <div class="mb-3">
            <label for="question_{{ $i }}" class="form-label">Question {{ $i + 1 }}</label>
            <input type="text" name="questions[]" id="question_{{ $i }}" class="form-control" value="{{ old('questions.' . $i) }}" required>
        </div>
    @endfor

    <button type="submit" class="btn btn-success">Save Quiz</button>
    <a href="{{ route('admin.quiz.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
