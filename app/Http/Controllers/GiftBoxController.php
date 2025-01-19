<?php

namespace App\Http\Controllers;

use App\Models\GiftBox;
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

    public function addToBox(Request $request)
    {
        $itemId = $request->input('item_id');
        $boxId = $request->input('box_id');

        // Sessiyadan mövcud item-ları al
        $selectedItems = session()->get("selected_items_for_box_$boxId", []);

        // Item artıq seçilibsə əlavə etmə
        if (in_array($itemId, $selectedItems)) {
            return response()->json([
                'message' => 'Bu item artıq qutuya əlavə edilib.',
                'status' => 'exists',
            ]);
        }

        // Yeni item məlumatlarını al
        $item = ChooseItem::findOrFail($itemId);

        // Seçilmiş item-ların ümumi həcmini hesabla
        $items = ChooseItem::whereIn('id', $selectedItems)->get();
        $totalItemsVolume = $items->sum('volume') + $item->volume; // Yeni item əlavə olunur

        // Qutunun həcmini tap
        $giftBox = GiftBox::with('boxCategory')->findOrFail($boxId);
        $boxVolume = $giftBox->volume;

        // Əgər həcm limiti keçərsə əlavə etmə
        if ($totalItemsVolume > $boxVolume) {
            return response()->json([
                'message' => 'Bu item qutuya yerləşə bilməz. Həcm limiti keçilir!',
                'status' => 'exceeded',
                'fillPercentage' => ($totalItemsVolume / $boxVolume) * 100,
            ]);
        }

        // Yeni item əlavə et
        $selectedItems[] = $itemId;
        session()->put("selected_items_for_box_$boxId", $selectedItems);

        // Progress bar məlumatları
        $fillPercentage = ($totalItemsVolume / $boxVolume) * 100;

        return response()->json([
            'message' => 'Item qutuya əlavə edildi.',
            'status' => 'added',
            'fillPercentage' => $fillPercentage,
            'totalItemsVolume' => $totalItemsVolume,
            'boxVolume' => $boxVolume,
        ]);
    }

    public function addItemToBox(Request $request)
    {
        try {
            // Məhsulu əldə et
            $item = ChooseItem::findOrFail($request->choose_item_id);

            // Session'dan box_category_id'yi al
            $boxCategoryId = Session::get('selected_box_category_id');
            if (!$boxCategoryId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Qutu seçilməyib.'
                ]);
            }

            // BoxCategory-dən qutu ölçülərini əldə et
            $boxCategory = BoxCategory::findOrFail($boxCategoryId);

            // Qutunun həcmi (width x height x length)
            $boxVolume = $boxCategory->width * $boxCategory->height * $boxCategory->length;

            // Məhsulun həcmi (width x height x length)
            $itemVolume = $item->width * $item->height * $item->length;

            // Sessiyadakı mövcud məhsulları al
            $existingItems = Session::get('selected_items', []);

            // Mövcud məhsulların ümumi həcmini hesabla
            $currentVolume = 0;
            foreach ($existingItems as $existingItem) {
                // Məhsul həcmini əldə et
                $existingItemObj = ChooseItem::find($existingItem['item_id']);
                if ($existingItemObj) {
                    $currentVolume += ($existingItemObj->width * $existingItemObj->height * $existingItemObj->length);
                }
            }

            // Yeni məhsulu əlavə etdikdən sonra ümumi həcm
            $newTotalVolume = $currentVolume + $itemVolume;

            // Debug məlumatları
            \Log::info('Box Volume: ' . $boxVolume);
            \Log::info('Current Volume: ' . $currentVolume);
            \Log::info('New Item Volume: ' . $itemVolume);
            \Log::info('New Total Volume: ' . $newTotalVolume);

            // Həcmi yoxla
            if ($newTotalVolume > $boxVolume) {
                return response()->json([
                    'success' => false,
                    'message' => 'Qutunun həcmi dolmuşdur. Yeni məhsul əlavə etmək mümkün deyil.',
                    'boxVolume' => $boxVolume,
                    'currentVolume' => $currentVolume,
                    'itemVolume' => $itemVolume,
                    'newTotalVolume' => $newTotalVolume
                ]);
            }

            // Yeni məhsul məlumatları
            $itemData = [
                'item_id' => $item->id,
                'item_name' => $item->name,
                'item_image' => $item->normal_image,
                'item_price' => $request->variant_price ?? $item->price,
                'item_volume' => $itemVolume,
            ];

            // Sessiyaya əlavə et
            $existingItems[] = $itemData;
            Session::put('selected_items', $existingItems);

            return response()->json([
                'success' => true,
                'message' => 'Məhsul qutuya əlavə edildi.',
                'boxVolume' => $boxVolume,
                'currentVolume' => $currentVolume,
                'itemVolume' => $itemVolume,
                'remainingVolume' => $boxVolume - $newTotalVolume
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function viewBoxItems(Request $request)
    {
        try {
            // Session'dan box_category_id'yi al
            $boxCategoryId = Session::get('selected_box_category_id');
            if (!$boxCategoryId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Qutu seçilməyib.'
                ]);
            }

            // BoxCategory-dən qutu ölçülərini əldə et
            $boxCategory = BoxCategory::findOrFail($boxCategoryId);
            $boxVolume = $boxCategory->width * $boxCategory->height * $boxCategory->length;

            $existingItems = Session::get('selected_items', []);
            $currentVolume = 0;

            foreach ($existingItems as $item) {
                $itemObj = ChooseItem::find($item['item_id']);
                if ($itemObj) {
                    $currentVolume += ($itemObj->width * $itemObj->height * $itemObj->length);
                }
            }

            return response()->json([
                'success' => true,
                'items' => $existingItems,
                'boxVolume' => $boxVolume,
                'currentVolume' => $currentVolume,
                'remainingVolume' => $boxVolume - $currentVolume,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta: ' . $e->getMessage()
            ], 500);
        }
    }
}
