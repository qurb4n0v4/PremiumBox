<?php

namespace App\Http\Controllers;

use App\Models\UserCardForBuildABox;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $userCards = UserCardForBuildABox::with(['items.images', 'card'])
            ->where('user_id', auth()->id())
            ->get();

        return view('front.cart', compact('userCards'));
    }
}
