<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PremadeBox;

class PremadeBoxController extends Controller
{
    public function index()
    {
        $premadeBoxes = PremadeBox::all();
        $currentStep = session('currentStep', 1);

        return view('front.premade.choose_premade', compact('premadeBoxes', 'currentStep'));
    }
}
