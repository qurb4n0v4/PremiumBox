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
            $premadeBoxDetail = PremadeBox::where('id', $id)->first();
        } else {
            $premadeBoxDetail = null;
        }

        return view('front.premade.choose_premade', compact('premadeBoxes', 'premadeBoxDetail', 'currentStep'));
    }
}
