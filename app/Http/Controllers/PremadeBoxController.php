<?php

namespace App\Http\Controllers;

use App\Models\PremadeBoxCustomize;
use Illuminate\Http\Request;
use App\Models\PremadeBox;
use App\Models\GiftBox;
use App\Models\Card;
use App\Models\PremadeBoxInsiding;

class PremadeBoxController extends Controller
{
    public function index($id = null)
    {
        $premadeBoxes = PremadeBox::all();
        $currentStep = session('currentStep', 1);

        $premadeBoxDetail = $id
            ? PremadeBox::find($id)
            : null;

        if ($id && !$premadeBoxDetail) {
            return redirect()->back()->with('error', 'Box not found.');
        }

        $premadeBoxInsidings = $id
            ? PremadeBoxInsiding::where('premade_boxes_id', $id)->get()
            : null;

        if ($id && $premadeBoxInsidings->isEmpty()) {
            return redirect()->back()->with('error', 'Box insidings not found.');
        }

        return view('front.premade.choose_premade', compact('premadeBoxes', 'premadeBoxDetail', 'premadeBoxInsidings', 'currentStep'));
    }

    public function show($id)
    {
        $premadeBoxDetail = PremadeBox::findOrFail($id);
        $currentStep = session('currentStep', 1);
        $cards = Card::all();
        $insidings = PremadeBoxInsiding::where('premade_boxes_id', $id)->get();

        // PremadeBoxCustomize'dan veriyi çekelim
        $boxes = PremadeBoxCustomize::where('premade_boxes_id', $id)
            ->pluck('boxes')
            ->first();

        $giftBoxes = [];
        if ($boxes && is_array($boxes)) {  // is_array kontrolü ekledik
            foreach ($boxes as $box) {
                if (isset($box['gift_boxes_id'])) {
                    $giftBox = GiftBox::find($box['gift_boxes_id']);
                    if ($giftBox) {
                        $giftBoxes[] = [
                            'id' => $giftBox->id,
                            'title' => $giftBox->title,
                            'image' => asset($giftBox->image),
                        ];
                    }
                }
            }
        }

        return view('front.premade.customize_premade', compact(
            'premadeBoxDetail',
            'currentStep',
            'insidings',
            'cards',
            'giftBoxes'
        ));
    }
}
