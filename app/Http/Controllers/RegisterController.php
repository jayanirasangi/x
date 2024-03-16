<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected function redirectTo()
    {
        return route('home'); // adjust to your landing page after registration
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // set default role here if applicable
        ]);

        // ... additional logic after user creation, like email verification, etc.

        return redirect()->to($this->redirectTo())->with('success', 'Registration successful!');
    }
}
