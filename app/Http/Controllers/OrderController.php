<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserCardForBuildABox;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Only fetch orders with "completed" or "rejected" status
        $orders = UserCardForBuildABox::with([
            'userBuildABoxCardItems.chooseItem',
            'giftBox',
            'card',
            'userBuildABoxCardItems.images'
        ])
            ->where('user_id', auth()->id())
            ->whereIn('status', ['completed', 'rejected']) // Filter for 'completed' or 'rejected' status
            ->get();

        return view('front.user.orders', compact('orders'));
    }
}
