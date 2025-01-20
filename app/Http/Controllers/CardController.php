<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
{
    public function index($id = null)
    {
        $cards = Card::all();

        if ($id) {
            $cardDetail = Card::where('id', $id)->first();

            if (!$cardDetail) {
                return redirect()->back()->with('error', 'Card not found.');
            }
        } else {
            $cardDetail = null;
        }

        return view('front.premade.customize_premade', compact('cards', 'cardDetail'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'nullable|numeric',
        ]);

        // Görseli sakla
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cards', 'public'); // 'cards' dizinine kaydedilir
        }

        // Yeni bir kart oluştur
        Card::create([
            'name' => $request->name,
            'image' => $imagePath,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Kart başarıyla oluşturuldu.');
    }

}
