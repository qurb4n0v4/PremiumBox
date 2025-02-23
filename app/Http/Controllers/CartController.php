<?php

namespace App\Http\Controllers;

use App\Models\UserCardForBuildABox;
use App\Models\UserCardForPremadeBox;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Kullanıcı giriş yapmışsa ve sadece "pending" statüsündeki userCards verilerini al
        $userCards = auth()->check()
            ? UserCardForBuildABox::with([
                'card',
                'userBuildABoxCardItems.chooseItem'
            ])
                ->where('user_id', auth()->id())
                ->where('status', 'pending')
                ->get()
            : collect(); // Kullanıcı yoksa boş bir koleksiyon döner

        // Premade box siparişlerini al
        $premadeBoxOrders = auth()->check()
            ? UserCardForPremadeBox::with('giftBox', 'premadeBox.insidings',)
                ->where('user_id', auth()->id())
                ->where('status', 'pending') // Sadece 'pending' olanları al
                ->get()
            : collect(); // Kullanıcı yoksa boş bir koleksiyon döner

        // Verileri görünüm dosyasına gönder
        return view('front.cart', compact('userCards', 'premadeBoxOrders'));
    }

    public function destroy($id, $type)
    {
        if ($type === 'build-a-box') {
            // Kullanıcıya ait build-a-box kartını bul ve sil
            $userCard = UserCardForBuildABox::where('user_id', auth()->id())->findOrFail($id);
        } elseif ($type === 'premade-box') {
            // Kullanıcıya ait premade-box siparişini bul ve sil
            $userCard = UserCardForPremadeBox::where('user_id', auth()->id())->findOrFail($id);
        } else {
            return redirect()->route('cart.index')->with('error', 'Geçersiz tür.');
        }

        // Kartı sil
        $userCard->delete();

        // Başarıyla silindiğine dair kullanıcıya mesaj göster
        return redirect()->route('cart.index')->with('success', 'Sifariş uğurla silindi.');
    }
}
