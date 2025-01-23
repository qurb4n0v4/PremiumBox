<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserCardForBuildABox;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Sadece tamamlanmış siparişleri çek
        $orders = UserCardForBuildABox::with('userBuildABoxCardItems.chooseItem')
            ->where('user_id', auth()->id())
            ->where('status', 'done') // Tamamlanmış siparişler
            ->get();

        return view('front.user.orders', compact('orders'));
    }
}
