<?php

namespace App\Http\Controllers;

use App\Models\UserCardForBuildABox;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Kullanıcı giriş yapmışsa userCards verilerini al
        $userCards = auth()->check()
            ? UserCardForBuildABox::with([
                'card',                   // Kart bilgisi ilişkisi
                'userBuildABoxCardItems.chooseItem' // Kullanıcının seçtiği eşyalar ve item bilgisi
            ])->where('user_id', auth()->id())->get()
            : collect(); // Kullanıcı yoksa boş bir koleksiyon döner

        // Verileri görünüm dosyasına gönder
        return view('front.cart', compact('userCards'));
    }
    public function checkout(Request $request)
    {
        $userCards = UserCardForBuildABox::with('userBuildABoxCardItems.chooseItem')
            ->where('user_id', auth()->id())
            ->get();

        foreach ($userCards as $userCard) {
            $userCard->status = 'completed'; // Durum güncellemesi
            $userCard->save();
        }

        return redirect()->route('orders.index')->with('success', 'Səbətiniz uğurla sifariş edildi.');
    }
}
