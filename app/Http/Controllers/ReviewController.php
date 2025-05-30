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

        Review::create([
            'name' => $request->name,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Review submitted!');
    }

    // Show the form and list of reviews
    public function showForm()
    {
        $reviews = Review::latest()->get();
        return view('User.reviewViews.review', compact('reviews'));
    }

    // Show all reviews (admin/user)
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('User.reviewViews.all-reviews', compact('reviews'));
    }

    // Show the edit form for any review (no restriction)
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('User.reviewViews.edit-review', compact('review'));
    }

    // Update any review (no restriction)
    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        $review = Review::findOrFail($id);
        $review->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('review.index')->with('success', 'Review updated.');
    }

    // Delete any review (no restriction)
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return back()->with('success', 'Review deleted.');
    }
}