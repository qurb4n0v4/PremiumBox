<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('admin.html.dashboard.auth.sign-in');
    }

    public function login(Request $request)
    {
        // İstifadəçinin daxil etdiyi məlumatları alın
        $credentials = $request->only('email', 'password');

        // Məlumatları yoxlayın
        if (Auth::guard('admin')->attempt($credentials)) {
            // Əgər daxil olarsa, admin panelinə yönləndir
            return redirect()->route('admin.dashboard');
        }

        // Əgər daxil ola bilməzsə, səhv mesajı ilə geri dön
        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }
}
