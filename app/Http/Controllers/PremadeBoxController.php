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

        if ($id) {
            $premadeBoxDetail = PremadeBox::where('id', $id);
            $box = PremadeBox::find($id);

            if (!$box) {
                return redirect()->back()->with('error', 'Box not found.');
            }
        } else {
            $premadeBoxDetail = PremadeBox::all();

        }

        if ($id) {
            $boxInsidings = PremadeBoxInsiding::where('premade_boxes_id', $id)->get();

            if (!$boxInsidings) {
                return redirect()->back()->with('error', 'Box not found.');
            }

            $premadeBoxInsidings = $boxInsidings->insidings;
        } else {
            $premadeBoxInsidings = null;
        }

        return view('front.premade.choose_premade', compact('premadeBoxes', 'premadeBoxDetail', 'premadeBoxInsidings', 'currentStep'));
    }

    public function show($id)
    {
        $premadeBoxDetail = PremadeBox::findOrFail($id);
        $currentStep = session('currentStep', 1);

        $insidings = PremadeBoxInsiding::where('premade_boxes_id', $id)->get();
        $customizedBoxes = PremadeBoxCustomize::where('premade_boxes_id', $id)->pluck('boxes');

        $boxes = $customizedBoxes->map(function ($box) {
            return json_decode($box, true);
        });

        $cards = Card::all();

        return view('front.premade.customize_premade', compact('premadeBoxDetail', 'currentStep', 'insidings', 'boxes', 'cards'));
    }
}
