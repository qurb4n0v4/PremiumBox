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

        // Fetch items with both choose variants and custom product details
        $chooseItems = ChooseItem::with([
            'chooseVariants' => function($query) {
                $query->select([
                    'id',
                    'choose_item_id',
                    'variants',
                    'images',
                    'variant_selection_title',
                    'available_same_day_delivery',
                    'paragraph',
                    'has_custom_text',
                    'text_field_placeholder'
                ]);
            },
            'customProductDetails' => function($query) {
                $query->select([
                    'id',
                    'choose_item_id',
                    'images',
                    'same_day_delivery',
                    'description'
                ]);
            }
        ])->get();

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
