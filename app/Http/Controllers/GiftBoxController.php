<?php

namespace App\Http\Controllers;

use App\Models\GiftBox;
use App\Models\BoxCategory;
use Illuminate\Http\Request;
use App\Models\ChooseItem;


class GiftBoxController extends Controller
{
    public function index()
    {
        $categories = BoxCategory::with('boxes')->get();
        $currentStep = session('currentStep', 1);



        return view('front.build_a_box.choose_a_box', compact('categories', 'currentStep'));
    }

    public function chooseItems()
    {
        $currentStep = session('currentStep', 1);
        $chooseItems = ChooseItem::all();


        return view('front.build_a_box.choose_items', compact('currentStep', 'chooseItems'));
    }

    public function chooseStep($step)
    {
        $currentStep = $step;
        session(['currentStep' => $currentStep]);

        if ($step == 1) {
            return redirect()->route('choose_a_box');
        } elseif ($step == 2) {
            return redirect()->route('choose.items');
        } elseif ($step == 3) {
            return redirect()->route('choose.card');
        } elseif ($step == 4) {
            return redirect()->route('order.complete');
        }

        return redirect()->route('choose.box');
    }


}
