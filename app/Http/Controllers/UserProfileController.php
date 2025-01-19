<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('front.user.profile');
    }

    public function showProfile()
    {
        $user = auth()->user();
        $editMode = false;

        return view('front.user.profile-details', compact('user', 'editMode'));
    }
    public function editProfile()
    {
        $user = auth()->user();
        $editMode = true;

        return view('front.user.profile-details', compact('user', 'editMode'));
    }

    public function showOrders()
    {
        $userId = auth()->id(); // Giriş yapmış kullanıcının ID'sini al
        $orders = \App\Models\Order::where('user_id', $userId)
            ->with(['giftBox', 'bag', 'card']) // İlişkileri yükle
            ->get();

        // View'e orders değişkeniyle gönder
        return view('front.user.orders', compact('orders'));
    }

    public function showCoupons()
    {
        return view('front.user.coupons');
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date|date_format:Y-m-d',
            'gender' => 'nullable|string|in:male,female,other',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
        ]);


        auth()->user()->update([
            'name' => $request->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('profile-details')->with('success', 'Profile updated successfully!');
    }
}
