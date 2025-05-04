<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();
        
        // If no user is authenticated, use a dummy user for demo purposes
        if (!$user) {
            $user = User::where('username', 'amanda12')->first();
            
            // If the demo user doesn't exist, create it
            if (!$user) {
                $user = User::create([
                    'fullname' => 'Amanda Lopez',
                    'dob' => '1995-05-03',
                    'phone' => '+1234567890',
                    'gender' => 'female',
                    'email' => 'amandalopez@gmail.com',
                    'username' => 'amanda12',
                    'password' => Hash::make('password123'),
                ]);
            }
        }
        
        // Parse the full name into first and last name
        $nameParts = explode(' ', $user->fullname, 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';
        
        return view('user.UserProfileViews.index', [
            'user' => $user,
            'firstName' => $firstName,
            'lastName' => $lastName,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        // Get the authenticated user
        $user = Auth::user();
        
        // If no user is authenticated, use a dummy user for demo purposes
        if (!$user) {
            $user = User::where('username', 'amanda12')->first();
        }
        
        // Parse the full name into first and last name
        $nameParts = explode(' ', $user->fullname, 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';
        
        return view('user.UserProfileViews.edit', [
            'user' => $user,
            'firstName' => $firstName,
            'lastName' => $lastName,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Check if reset button was clicked
        if ($request->has('reset')) {
            return $this->resetToDefault($request);
        }
        
        // Get the authenticated user or demo user first to check current values
        $user = Auth::user();
        if (!$user) {
            $user = User::where('username', 'amanda12')->first();
        }
        
        // Prepare validation rules - only check uniqueness if value has changed
        $rules = [
            'firstname' => 'sometimes|nullable|string|max:100',
            'lastname' => 'sometimes|nullable|string|max:100',
            'gender' => 'sometimes|in:male,female,other',
            'phone' => 'sometimes|nullable|string|max:20',
            'dob' => 'sometimes|nullable|date',
            'profile_picture' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:2048'
        ];
        
        // Only validate username uniqueness if it's changed
        if ($request->filled('username') && $request->username !== $user->username) {
            $rules['username'] = 'sometimes|string|max:50|unique:users,username,' . ($user->id ?? '0');
        } else {
            $rules['username'] = 'sometimes|nullable|string|max:50';
        }
        
        // Email validation - don't check uniqueness against the user's own email
        if ($request->has('email')) {
            if ($request->email !== $user->email) {
                // New email, check uniqueness
                $rules['email'] = 'required|email|max:255|unique:users,email,' . $user->id;
            } else {
                // Same email, no uniqueness check needed
                $rules['email'] = 'required|email|max:255';
            }
        }
        
        // Validate the request data with our improved rules
        $validated = $request->validate($rules);
        
        // We already have the user from above, no need to get it again
        
        // Only update fullname if both firstname and lastname are provided
        if (isset($validated['firstname']) && isset($validated['lastname'])) {
            $fullname = $validated['firstname'] . ' ' . $validated['lastname'];
            $user->fullname = $fullname;
        } elseif (isset($validated['firstname'])) {
            // If only firstname is provided, keep the last name
            $nameParts = explode(' ', $user->fullname, 2);
            $lastName = $nameParts[1] ?? '';
            $user->fullname = $validated['firstname'] . ($lastName ? ' ' . $lastName : '');
        } elseif (isset($validated['lastname'])) {
            // If only lastname is provided, keep the first name
            $nameParts = explode(' ', $user->fullname, 2);
            $firstName = $nameParts[0] ?? '';
            $user->fullname = $firstName . ' ' . $validated['lastname'];
        }
        
        // Update other user data only if they are provided
        if (isset($validated['username'])) {
            $user->username = $validated['username'];
        }
        
        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }
        
        if (isset($validated['gender'])) {
            $user->gender = $validated['gender'];
        }
        
        if (isset($validated['phone'])) {
            $user->phone = $validated['phone'];
        }
        
        if (isset($validated['dob'])) {
            $user->dob = $validated['dob'];
        }
        
        // Handle profile picture upload with a very simple approach
        if ($request->hasFile('profile_picture')) {
            try {
                // Get the uploaded file
                $file = $request->file('profile_picture');
                
                // Create the directory if it doesn't exist
                $path = public_path('images');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                // Create a simple filename
                $filename = 'profile_' . time() . '.' . $file->getClientOriginalExtension();
                
                // Move the file
                $file->move($path, $filename);
                
                // Update the user's profile picture field
                $user->profile_picture = $filename;
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to upload profile picture: ' . $e->getMessage());
            }
        }
        
        // Save the user
        $user->save();
        
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }
    
    /**
     * Reset user profile to default values
     */
    public function resetToDefault(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();
        
        // If no user is authenticated, use a dummy user for demo purposes
        if (!$user) {
            $user = User::where('username', 'amanda12')->first();
        }
        
        // Set default values
        $user->fullname = 'Amanda Lopez';
        $user->username = 'amanda12';
        $user->email = 'amandalopez@gmail.com';
        $user->gender = 'female';
        $user->phone = '+1234567890';
        $user->dob = '1995-05-03';
        
        // Remove profile picture if exists
        if ($user->profile_picture && Storage::exists('public/profile_pictures/' . $user->profile_picture)) {
            Storage::delete('public/profile_pictures/' . $user->profile_picture);
            $user->profile_picture = null;
        }
        
        // Save the user
        $user->save();
        
        return redirect()->route('user.profile.edit')->with('success', 'Profile reset to default values.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
