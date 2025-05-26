@extends('admin.index')

@section('content')
<div class="quiz-content">
    <h1 class="quiz-title">Quiz List</h1>
    <div class="search-bar">
        <form action="{{ route('admin.quiz.index') }}" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Search for quiz" value="{{ request('search') }}">
            <link rel="stylesheet" href="{{ asset('css/Admin/quiz.css') }}">
            <button type="submit" class="btn btn-success">Search</button>
        </form>
        <a href="{{ route('admin.quiz.create') }}" class="btn btn-primary">Add New</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($quizzes->count())
        <div class="quiz-list">
            @foreach($quizzes as $quiz)
                <div class="quiz-card">
                    <div class="quiz-card-title">{{ $quiz->title }}</div>
                    <div class="quiz-actions">
                        <a href="{{ route('admin.quiz.edit', $quiz->id) }}" class="btn btn-warning btn-card">Edit</a>
                        <form action="{{ route('admin.quiz.destroy', $quiz->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this quiz?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-card" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No quizzes found.</p>
    @endif
</div>
@endsection
