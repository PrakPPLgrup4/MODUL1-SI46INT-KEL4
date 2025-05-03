<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Psych;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all psychiatrists from the database to display on the admin page
        $psychs = Psych::all();

        // Return the admin psychs view and pass the psychiatrists data
        return view('admin.psychs.index', compact('psychs'));
    }

    public function create()
    {
        // Return the view where the admin can create a new psychiatrist profile
        return view('admin.psychs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|unique:psychs,username|max:255',
            'password' => 'required|string|min:8',
            'description' => 'required|string',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Handle file upload for the picture
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('psych_pictures', 'public');
        }

        // Create a new psychiatrist record in the database
        $psych = Psych::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'description' => $request->description,
            'picture' => $picturePath,
            'average_rating' => 0,
            'rating_count' => 0,
        ]);

        return redirect()->route('admin.psychs')->with('success', 'Psychiatrist profile created successfully!');
    }

    public function edit($id)
    {
        // Fetch the psychiatrist by ID to edit
        $psych = Psych::findOrFail($id);
        return view('admin.psychs.edit', compact('psych'));
    }

    public function update(Request $request, $id)
    {
        $psych = Psych::findOrFail($id);
    
        // Validate the updated data
        $request->validate([
        'full_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:psychs,username,' . $id,
        'password' => 'nullable|string|min:8',
        'description' => 'required|string',
        'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Handle picture update
        if ($request->hasFile('picture')) {
            // Delete the old picture if it exists
            if ($psych->picture && \Storage::exists('public/' . $psych->picture)) {
                \Storage::delete('public/' . $psych->picture);
            }
        
        // Store the new picture
        $picturePath = $request->file('picture')->store('psych_pictures', 'public');
        $psych->picture = $picturePath;
        }

        // If password is provided, update it
        if ($request->password) {
            $psych->password = bcrypt($request->password);
        }

        // Update the psychiatrist details
        $psych->full_name = $request->full_name;
        $psych->username = $request->username;
        $psych->description = $request->description;

        // Save the updated psychiatrist record
        $psych->save();

        return redirect()->route('admin.psychs')->with('success', 'Psychiatrist profile updated successfully!');
    }


    public function destroy($id)
    {
        $psych = Psych::findOrFail($id);
        $psych->delete();

        return redirect()->route('admin.psychs')->with('success', 'Psychiatrist profile deleted successfully!');
    }
}
