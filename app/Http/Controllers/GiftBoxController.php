<?php

namespace App\Http\Controllers;

use App\Models\GiftBox;
use App\Models\BoxCategory;
use Illuminate\Http\Request;
use App\Models\ChooseItem;
use App\Models\Card;



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
            ->map(function($item) {
                return ['id' => $item, 'name' => $item];
            });

        $production_times = ChooseItem::select('production_time')
            ->distinct()
            ->whereNotNull('production_time')
            ->pluck('production_time')
            ->map(function($item) {
                return ['id' => $item, 'name' => $item];
            });

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
                    'same_day_delivery',
                    'description',
                    'images',
                    'allow_user_images',
                    'image_upload_title',
                    'max_image_count',
                    'has_variants',
                    'variant_selection_title',
                    'variants',
                    'has_custom_text',
                    'text_field_placeholder',
                    'created_at',
                    'updated_at'
                ]);
            }

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
            return redirect()->route('order.complete');        }

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
        // Sessiyada saxlanılan məlumatları götürmək
        $selectedBox = session('selectedBox');
        $selectedItems = session('selectedItems');
        $selectedCard = session('selectedCard');
        $currentStep = session('currentStep', 1);


//        // Məlumatları yoxlamaq (istəyə görə)
//        if (!$selectedBox || !$selectedItems || !$selectedCard) {
//            return redirect()->route('front.choose_a_box')->with('error', 'Sifariş tam deyil.');
//        }

        // done.blade.php görünüşünə məlumatları ötürmək
        return view('front.build_a_box.done', compact('selectedBox', 'selectedItems', 'selectedCard', 'currentStep'));
    }

}
