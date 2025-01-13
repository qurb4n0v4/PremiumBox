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
    const STEP_CHOOSE_BOX = 1;
    const STEP_CUSTOMIZE_BOX = 2;
    const STEP_COMPLETE = 3;

    public function index($id = null)
    {
        $premadeBoxes = PremadeBox::all();
        $currentStep = self::STEP_CHOOSE_BOX;

        $premadeBoxDetail = $id ? PremadeBox::find($id) : null;

        if ($id && !$premadeBoxDetail) {
            return redirect()->back()->with('error', 'Box not found.');
        }

        $premadeBoxInsiding = $id
            ? PremadeBox::with('insidings')->find($id)
            : null;

        if ($id && !$premadeBoxInsiding) {
            return redirect()->back()->with('error', 'Box not found.');
        }

        return view('front.premade.choose_premade', compact(
            'premadeBoxes',
            'premadeBoxDetail',
            'premadeBoxInsiding',
            'currentStep'
        ));
    }

    public function show($id = null)
    {
        $currentStep = self::STEP_CUSTOMIZE_BOX;

        if (!$id) {
            return view('front.premade.customize_premade', [
                'currentStep' => $currentStep,
                'premadeBoxDetail' => null,
                'cards' => [],
                'insidings' => [],
                'giftBoxes' => []
            ]);
        }

        try {
            $premadeBoxDetail = PremadeBox::with('details')->findOrFail($id);
            $cards = Card::all();
            $insidings = PremadeBoxInsiding::where('premade_boxes_id', $id)->get();

            $boxes = PremadeBoxCustomize::where('premade_boxes_id', $id)
                ->pluck('boxes')
                ->first();

            $giftBoxes = [];
            if ($boxes && is_array($boxes)) {
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
        } catch (\Exception $e) {
            return redirect()->route('choose_premade_box')->with('error', 'Qutu tapılmadı.');
        }
    }

    function done()
    {
        $currentStep = self::STEP_CUSTOMIZE_BOX;
        return view('front.premade.done_premade', compact('currentStep'));
    }
}
