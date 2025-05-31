<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PsychLoginController extends Controller
{
    // Show the psychiatrist login form
    public function showLoginForm()
    {
        return view('auth.psychlogin'); // make sure this matches your blade filename & path
    }

    // Process the login form submission
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('psych')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/psyci');
        }

        return back()->withErrors([
            'login_error' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('psych')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/psychologist/login');
    }
}
