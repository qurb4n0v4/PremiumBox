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
use App\Models\UserPremadeBoxItemImage;
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
            // User Authentication Check
            $user = auth()->user();
            if (!$user) {
                return response()->json([
                    'message' => 'Authentication required',
                    'error' => 'User must be logged in to create a premade box'
                ], 401);
            }

            // Comprehensive Validation
            $validatedData = $request->validate([
                'premade_box_id' => 'required|exists:premade_boxes,id',
                'gift_box_id' => 'required|exists:gift_boxes,id',
                'box_text' => 'required|string|max:255',
                'selected_font' => 'required|string|max:50',
                'card_details' => 'required|array',
                'card_details.card_id' => 'nullable|exists:cards,id',
                'card_details.to_name' => 'required|string|max:100',
                'card_details.from_name' => 'required|string|max:100',
                'card_details.message' => 'required|string|max:500',
                'items' => 'required|array',
                'items.*.insiding_id' => 'required|exists:premade_box_insidings,id',
                'items.*.selected_variant' => 'nullable|string',
                'items.*.custom_text' => 'nullable|string',
                'items.*.images' => 'nullable|array',
            ]);

            // Log request details
            \Log::info('Premade Box Store Request', [
                'user_id' => $user->id,
                'data' => $validatedData
            ]);

            // Create User Card for Premade Box
            $userCardForPremadeBox = UserCardForPremadeBox::create([
                'user_id' => $user->id,
                'premade_box_id' => $validatedData['premade_box_id'],
                'gift_box_id' => $validatedData['gift_box_id'],
                'box_text' => $validatedData['box_text'],
                'selected_font' => $validatedData['selected_font'],
                'status' => 'pending',
            ]);

            // Create Card Details
            $userCardDetails = $userCardForPremadeBox->userCardDetails()->create([
                'card_id' => $validatedData['card_details']['card_id'] ?? null,
                'to_name' => $validatedData['card_details']['to_name'],
                'from_name' => $validatedData['card_details']['from_name'],
                'message' => $validatedData['card_details']['message'],
            ]);

            // Process Items
            foreach ($validatedData['items'] as $itemData) {
                // Create Item
                $userPremadeBoxItem = $userCardForPremadeBox->items()->create([
                    'insiding_id' => $itemData['insiding_id'],
                    'selected_variant' => $itemData['selected_variant'] ?? null,
                    'custom_text' => $itemData['custom_text'] ?? null,
                ]);

                // Handle Image Uploads
                if (!empty($itemData['images'])) {
                    foreach ($itemData['images'] as $index => $imageFile) {
                        // Store image
                        $imagePath = $imageFile->store('upload_images', 'public');

                        // Create image record
                        $userPremadeBoxItem->images()->create([
                            'image_path' => $imagePath,
                            'order' => $index,
                        ]);
                    }
                }
            }

            // Commit transaction
            DB::commit();

            // Return success response
            return response()->json([
                'message' => 'Premade box successfully created',
                'data' => $userCardForPremadeBox->load('userCardDetails', 'items.images'),
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Rollback transaction on validation error
            DB::rollBack();

            \Log::error('Validation Error', [
                'errors' => $e->errors(),
                'input' => $request->all()
            ]);

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            // Rollback transaction on any other error
            DB::rollBack();

            \Log::error('Premade Box Store Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Error creating premade box',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
