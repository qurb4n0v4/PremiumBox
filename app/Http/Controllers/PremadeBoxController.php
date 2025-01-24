<?php

namespace App\Http\Controllers;

use App\Models\PremadeBoxCustomize;
use App\Models\PremadeBox;
use App\Models\GiftBox;
use App\Models\Card;
use App\Models\PremadeBoxInsiding;
use App\Models\UserCardDetail;
use App\Models\UserPremadeBoxItem;
use Illuminate\Support\Facades\DB;  // Burada DB class-ını daxil edirik
use Illuminate\Http\Request;
use App\Models\UserCardForPremadeBox;
use Illuminate\Support\Facades\Storage;


class PremadeBoxController extends Controller
{
    const STEP_CHOOSE_BOX = 1;
    const STEP_CUSTOMIZE_BOX = 2;
    const STEP_COMPLETE = 3;

    public function index($id = null)
    {
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

        $recipients = PremadeBox::select('recipient')
            ->distinct()
            ->whereNotNull('recipient')
            ->pluck('recipient')
            ->map(function($item) {
                return ['id' => $item, 'name' => $item];
            });

        $occasions = PremadeBox::select('occasion')
            ->distinct()
            ->whereNotNull('occasion')
            ->pluck('occasion')
            ->map(function($item) {
                return ['id' => $item, 'name' => $item];
            });

        $production_times = PremadeBox::select('production_time')
            ->distinct()
            ->whereNotNull('production_time')
            ->pluck('production_time')
            ->map(function($item) {
                return ['id' => $item, 'name' => $item];
            });

        $premadeBoxes = PremadeBox::with(['details', 'insidings'])->get();

        return view('front.premade.choose_premade', compact(
            'premadeBoxDetail',
            'premadeBoxInsiding',
            'currentStep',
            'recipients',
            'occasions',
            'production_times',
            'premadeBoxes'
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
//            dd($insidings);


            $boxes = PremadeBoxCustomize::where('premade_boxes_id', $id)
                ->pluck('boxes')
                ->first();

            $giftBoxes = [];
            if ($boxes) {
                $boxes = is_array($boxes) ? $boxes : json_decode($boxes, true);

                if (is_array($boxes)) {
                    foreach ($boxes as $box) {
                        if (isset($box['gift_boxes_id'])) {
                            $giftBox = GiftBox::find($box['gift_boxes_id']);
                            if ($giftBox) {
                                $giftBoxes[] = [
                                    'id' => $giftBox->id,
                                    'title' => $giftBox->title,
                                    'image' => $giftBox->image ? asset('storage/' . $giftBox->image) : asset('images/default.png'),
                                ];
                            }
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

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Create user card for premade box
            $userCardForPremadeBox = UserCardForPremadeBox::create([
                'user_id' => auth()->id() ?? null,
                'premade_box_id' => $request->input('gift_box_id'),
                'gift_box_id' => $request->input('gift_box_id'),
                'box_text' => $request->input('box_text'),
                'selected_font' => $request->input('selected_font'),
                'status' => 'pending'
            ]);

            // Create card details
            UserCardDetail::create([
                'user_card_for_premade_box_id' => $userCardForPremadeBox->id,
                'card_id' => $request->input('card_id'),
                'to_name' => $request->input('to_name'),
                'from_name' => $request->input('from_name'),
                'message' => $request->input('message')
            ]);

            // Process inside items
            $insidings = PremadeBoxInsiding::all();
            foreach ($insidings as $insiding) {
                // Prepare data for this insiding
                $customText = $request->input("custom_text_{$insiding->id}") ??
                    $request->input("dynamic_textarea_$insiding->id");

                $selectedVariant = $request->input("variant_{$insiding->id}") ??
                    $request->input("selected_variant_$insiding->id");

                $userPremadeBoxItem = UserPremadeBoxItem::create([
                    'user_card_for_premade_box_id' => $userCardForPremadeBox->id,
                    'insiding_id' => $insiding->id,
                    'custom_text' => $customText,
                    'selected_variant' => $selectedVariant
                ]);

                // Handle image uploads
                if ($request->hasFile("image_{$insiding->id}_0")) {
                    $image = $request->file("image_{$insiding->id}_0");
                    $imagePath = $image->store('premade_box_images', 'public');

                    $userPremadeBoxItem->update([
                        'image_path' => $imagePath
                    ]);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Premade box created successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Məhsul əlavə edilərkən xəta baş verdi',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
