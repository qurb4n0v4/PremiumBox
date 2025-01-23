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
        $request->validate([
            'box_id' => 'required|exists:gift_boxes,id',
            'premade_box_id' => 'required|exists:premade_boxes,id',
            'box_text' => 'required|string|max:255',
            'selected_font' => 'required|string',
            'to_name' => 'required_with:card_id|string|max:255',
            'from_name' => 'required_with:card_id|string|max:255',
            'card_message' => 'required_with:card_id|string',
        ]);

        try {
            DB::beginTransaction();

            // Əsas sifariş məlumatlarının yaradılması
            $userCard = UserCardForPremadeBox::create([
                'user_id' => auth()->id(),
                'premade_box_id' => $request->premade_box_id,
                'gift_box_id' => $request->box_id, // buradakı dəyərin düzgün olub olmadığını yoxlayın
                'box_text' => $request->box_text,
                'selected_font' => $request->selected_font,
                'status' => 'pending'
            ]);


            // Kart məlumatlarının saxlanması (əgər varsa)
            if ($request->has('card_id')) {
                UserCardDetail::create([
                    'user_card_for_premade_box_id' => $userCard->id,
                    'card_id' => $request->card_id,
                    'to_name' => $request->to_name,
                    'from_name' => $request->from_name,
                    'message' => $request->card_message
                ]);
            }

            // Qutu içindəki əşyaların məlumatlarının saxlanması
            $insidings = json_decode($request->insiding_items, true);

            foreach ($insidings as $item) {
                $uploadedImages = [];

                if (isset($item['uploaded_image']) && is_array($item['uploaded_image'])) {
                    foreach ($item['uploaded_image'] as $base64Image) {
                        $imagePath = $this->saveBase64Image($base64Image, 'insiding_images');
                        if ($imagePath) {
                            $uploadedImages[] = $imagePath;
                        }
                    }
                }

                // `selected_variant` massivini JSON formatında saxla
                $selectedVariant = isset($item['selected_variant'])
                    ? json_encode($item['selected_variant'])
                    : null;

                // Veritabanına daxil et
                $boxItem = UserPremadeBoxItem::create([
                    'user_card_for_premade_box_id' => $userCard->id,
                    'insiding_id' => $item['insiding_id'],
                    'selected_variant' => $selectedVariant,
                    'custom_text' => $item['custom_text'] ?? null,
                    'uploaded_images' => count($uploadedImages) > 0
                        ? json_encode($uploadedImages)
                        : null
                ]);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Məlumatlar uğurla yadda saxlanıldı',
                'redirect_url' => route('done_premade')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Premade box customization error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }

    private function saveBase64Image($base64Image, $folder)
    {
        try {
            \Log::info('Full Base64 Input Length: ' . strlen($base64Image));
            \Log::info('Base64 Start: ' . substr($base64Image, 0, 50) . '...');

            // Base64 stringinin düzgün formatda olub-olmadığını yoxlayın
            if (strpos($base64Image, 'data:') !== 0) {
                \Log::error('Invalid base64 image format');
                return null;
            }

            $image_parts = explode(";base64,", $base64Image);

            \Log::info('Image Parts Count: ' . count($image_parts));
            if (count($image_parts) !== 2) {
                \Log::error('Incorrect base64 image parts');
                return null;
            }

            // Düzəliş: image type çıxarılması
            $image_type_aux = explode("/", str_replace('data:', '', $image_parts[0]));

            \Log::info('Image Type Aux: ' . json_encode($image_type_aux));
            if (count($image_type_aux) !== 2) {
                \Log::error('Incorrect image type');
                return null;
            }

            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            if ($image_base64 === false) {
                \Log::error('Base64 decode failed');
                return null;
            }

            $filename = uniqid() . '.' . $image_type;
            $path = $folder . '/' . $filename;

            Storage::disk('public')->put($path, $image_base64);

            \Log::info('Şəkil saxlanıldı: ' . $path);

            return $path;
        } catch (\Exception $e) {
            \Log::error('Şəkil saxlama xətası: ' . $e->getMessage());
            return null;
        }
    }
}
