<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showOrders()
    {
        // Kullanıcının siparişlerini al
        $userId = auth()->id(); // Giriş yapmış kullanıcının ID'si
        $orders = Order::where('user_id', $userId)->with('giftBox', 'bag', 'card')->get();

        // View'e gönder
        return view('front.user.orders', compact('orders'));
    }
}
