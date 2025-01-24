<?php

namespace App\Http\Controllers;

use App\Models\UserCardForBuildABox;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Kullanıcı giriş yapmışsa ve sadece "pending" statüsündeki userCards verilerini al
        $userCards = auth()->check()
            ? UserCardForBuildABox::with([
                'card',                   // Kart bilgisi ilişkisi
                'userBuildABoxCardItems.chooseItem' // Kullanıcının seçtiği eşyalar ve item bilgisi
            ])
                ->where('user_id', auth()->id()) // Kullanıcıya özel kartlar
                ->where('status', 'pending')     // Sadece "pending" olanları getir
                ->get()
            : collect(); // Kullanıcı yoksa boş bir koleksiyon döner

        // Verileri görünüm dosyasına gönder
        return view('front.cart', compact('userCards'));
    }
}
