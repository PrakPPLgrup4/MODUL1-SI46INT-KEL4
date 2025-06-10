<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('views.Homepage'); // user's homepage route
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('user')->attempt($credentials)) {
            $request->session()->regenerate(); // good practice to avoid session fixation
            return redirect()->route('views.Homepage');
        }

        return back()->withErrors([
            'username' => 'Invalid username or password', // better UX
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
