<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Your methods here
    public function login(Request $request)
    {
        // Validate user credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate user
        if (Auth::attempt($credentials)) {
            // Redirect to intended page after successful login
            return redirect()->intended('dashboard');
        }

        // Return to login form with error message if authentication fails
        return back()->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }
}


