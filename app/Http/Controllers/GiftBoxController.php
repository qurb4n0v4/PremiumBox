<?php

namespace App\Http\Controllers;

use App\Models\BoxCategory;
use Illuminate\Http\Request;
use App\Models\ChooseItem;
use App\Models\Card;
use Illuminate\Support\Facades\Session;

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

        $categories = ChooseItem::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->map(function ($item) {
                return ['id' => $item, 'name' => $item];
            });

        $production_times = ChooseItem::select('production_time')
            ->distinct()
            ->whereNotNull('production_time')
            ->pluck('production_time')
            ->map(function ($item) {
                return ['id' => $item, 'name' => $item];
            });

        $chooseItems = ChooseItem::with([
            'chooseVariants',
            'customProductDetails'
        ])->get();

        return view('front.build_a_box.choose_items', compact('currentStep', 'chooseItems', 'categories', 'production_times'));
    }

    public function chooseCard()
    {
        $cards = Card::all();
        $currentStep = session('currentStep', 1);
        return view('front.build_a_box.choose_a_card', compact('currentStep', 'cards'));
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
            if (!$this->checkCompletion()) {
                return redirect()->back()->with('error', 'Bütün xanaları doldurun.');
            }
            return redirect()->route('order.complete');
        }

        return redirect()->route('choose.box');
    }

    private function checkCompletion()
    {
        return session()->has('selectedBox') &&
            session()->has('selectedItems') &&
            session()->has('selectedCard');
    }

    public function orderComplete()
    {
        $selectedBox = session('selectedBox');
        $selectedItems = session('selectedItems');
        $selectedCard = session('selectedCard');
        $currentStep = session('currentStep', 1);

        return view('front.build_a_box.done', compact('selectedBox', 'selectedItems', 'selectedCard', 'currentStep'));
    }
}
