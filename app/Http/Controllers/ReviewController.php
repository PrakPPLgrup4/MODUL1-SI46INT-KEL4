<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Store the submitted review
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        Review::create($request->only('name', 'rating', 'review'));

        return back()->with('success', 'Review submitted!');
    }

    // Show the form and list of reviews
    public function showForm()
    {
        $reviews = Review::latest()->get();
        return view('User.reviewViews.review', compact('reviews'));
    }
    public function index()
{
    $reviews = \App\Models\Review::latest()->get();
    return view('User.reviewViews.all-reviews', compact('reviews'));
}
}

