<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserCardForBuildABox;
use App\Models\UserCardForPremadeBox;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // UserCardForBuildABox siparişlerini al
        $orders = UserCardForBuildABox::with([
            'userBuildABoxCardItems.chooseItem',
            'giftBox',
            'card',
            'userBuildABoxCardItems.images'
        ])
            ->where('user_id', auth()->id())
            ->whereIn('status', ['completed', 'rejected'])
            ->get();

        // Premade box siparişlerini al
        $premadeBoxOrders = auth()->check()
            ? UserCardForPremadeBox::with('giftBox')
                ->where('user_id', auth()->id())
                ->whereIn('status', ['accepted', 'rejected'])
                ->get()
            : collect(); // Kullanıcı yoksa boş bir koleksiyon döner

        return view('front.user.orders', compact('orders', 'premadeBoxOrders'));
    }
}
