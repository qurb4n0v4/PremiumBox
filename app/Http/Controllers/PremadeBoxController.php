<?php

namespace App\Http\Controllers;

use App\Models\PremadeBoxCustomize;
use Illuminate\Http\Request;
use App\Models\PremadeBox;
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
        $boxes = is_string($premadeBoxDetail->boxes)
            ? json_decode($premadeBoxDetail->boxes, true)
            : $premadeBoxDetail->boxes;

        return view('front.premade.customize_premade', compact('premadeBoxDetail', 'currentStep', 'insidings', 'boxes', 'cards'));
    }
}
