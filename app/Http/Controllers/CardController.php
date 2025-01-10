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

}
