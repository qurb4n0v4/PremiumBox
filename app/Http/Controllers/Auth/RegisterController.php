<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Make sure you include the User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        return view('admin.html.dashboard.auth.sign-up');
    }

    // Handle the registration logic
    public function store(Request $request)
    {
        // Validation for registration
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // password_confirmation should match 'password'
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encrypt password
        ]);

        // Login the user
        Auth::login($user);

        // Redirect to the dashboard with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Registration successful!');
    }
}
