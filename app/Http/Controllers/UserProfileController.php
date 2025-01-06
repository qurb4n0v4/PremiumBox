<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('front.user.profile');
    }

    public function showProfile()
    {
        $user = auth()->user();
        return view('front.user.profile-details', compact('user'));
    }

    public function showOrders()
    {
        $user = auth()->user();
        return view('front.user.orders', compact('user'));
    }

    public function showAddressList()
    {
        return view('front.user.addresses');
    }

    public function showCoupons()
    {
        return view('front.user.coupons');
    }
}
