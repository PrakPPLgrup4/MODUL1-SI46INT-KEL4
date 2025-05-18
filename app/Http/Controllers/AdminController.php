<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Psych;

class AdminController extends Controller
{
    public function index()
    {
        // Show the main admin dashboard page
        return view('Admin.index');
    }

    public function managePsychs()
    {
        // Fetch all psychiatrists to display on the psychiatrist management page
        $psychs = Psych::all();
        return view('admin.psychs.index', compact('psychs'));
    }

    public function create()
    {
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

        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('psych_pictures', 'public');
        }

        Psych::create([
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
        $psych = Psych::findOrFail($id);
        return view('admin.psychs.edit', compact('psych'));
    }

    public function update(Request $request, $id)
    {
        $psych = Psych::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:psychs,username,' . $id,
            'password' => 'nullable|string|min:8',
            'description' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('picture')) {
            if ($psych->picture && \Storage::exists('public/' . $psych->picture)) {
                \Storage::delete('public/' . $psych->picture);
            }
            $picturePath = $request->file('picture')->store('psych_pictures', 'public');
            $psych->picture = $picturePath;
        }

        if ($request->password) {
            $psych->password = bcrypt($request->password);
        }

        $psych->full_name = $request->full_name;
        $psych->username = $request->username;
        $psych->description = $request->description;

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
