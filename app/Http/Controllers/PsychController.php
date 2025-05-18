<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Psych;

class PsychController extends Controller
{
    public function index()
    {
        $psychs = Psych::all();  // Retrieves all psychiatrists from the database
        return view('User.PsychiatristViews.psych', compact('psychs'));
    }

    public function rate(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'psych_id' => 'required|exists:psychs,id', // Ensure the psych_id exists in the database
            'rating' => 'required|numeric|min:1|max:5', // Ensure the rating is between 1 and 5
        ]);

        // Find the psychiatrist by id
        $psych = Psych::find($request->psych_id);

        // Check if the psychiatrist exists
        if (!$psych) {
            return response()->json([
                'error' => 'Psychiatrist not found.',
            ], 404);
        }

        // Update the psychiatrist's average rating
        $totalRating = $psych->average_rating * $psych->rating_count; // Calculate the total rating
        $psych->rating_count++; // Increment the rating count
        $newTotalRating = $totalRating + $request->rating; // Add the new rating to the total
        $psych->average_rating = $newTotalRating / $psych->rating_count; // Calculate the new average rating

        // Save the updated psychiatrist data
        $psych->save();

        // Return a success response with the new average rating
        return response()->json([
            'success' => true,
            'message' => 'Rating submitted successfully!',
            'new_average_rating' => $psych->average_rating,
        ]);
    }
}
