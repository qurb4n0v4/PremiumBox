<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PremadeBox;

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

        return view('front.premade.choose_premade', compact('premadeBoxes', 'premadeBoxDetail', 'currentStep'));
    }

    public function show($id)
    {
        $premadeBoxDetail = PremadeBox::findOrFail($id);

        return view('front.premade.customize_premade', compact('premadeBoxDetail'));
    }
}
