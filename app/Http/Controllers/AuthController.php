<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'phone' => 'required|string'
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'phone' => $validated['phone'],
            ]);

            return response()->json([
                'message' => 'Qeydiyyat uğurla tamamlandı.',
                'user' => $user
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Qeydiyyat zamanı bir xəta baş verdi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'message' => 'Login successful',
                'redirect_url' => route('profile')
            ]);
        }

        return response()->json(['message' => 'The provided credentials do not match our records.'], 401);
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }


}
