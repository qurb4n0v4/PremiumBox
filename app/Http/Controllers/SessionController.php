<?php

namespace App\Http\Controllers;

use App\Models\GiftBox;
use App\Models\ChooseItem;
use App\Models\Card;
use Illuminate\Http\Request;
use App\Models\BoxCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class SessionController extends Controller
{
    public function saveBoxSelection(Request $request)
    {
        try {
            $box = GiftBox::findOrFail($request->gift_box_id);

            $boxData = [
                'box_id' => $box->id,
                'box_name' => $box->title,
                'box_image' => $box->image,
                'box_price' => $box->price,
                'customization_text' => $request->box_customization_text,
                'selected_font' => $request->selected_font
            ];

            Session::put('selected_box', $boxData);

            return response()->json([
                'success' => true,
                'message' => 'Qutu məlumatları saxlanıldı'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta: ' . $e->getMessage()
            ], 500);
        }
    }

    public function saveItemSelection(Request $request)
    {
        try {
//             Önce hacim kontrolü yap
            $volumeCheck = $this->checkBoxVolume($request);
            $volumeResponse = json_decode($volumeCheck->getContent(), true);

            // Kutunun seçilip seçilmediğini kontrol et
            $selectedBox = Session::get('selected_box');
            if (!$selectedBox && (!$request->has('selected_box') || empty($request->input('selected_box')))) {
                return response()->json([
                    'success' => false,
                    'error_code' => 'NO_BOX_SELECTED',
                    'message' => 'Zəhmət olmasa əvvəlcə qutu seçin!'
                ]);
            }

//             Hacim kontrolü başarısızsa, hata mesajını gönder
            if (!$volumeResponse['success']) {
                return response()->json([
                    'success' => false,
                    'error_code' => 'TOO_LARGE', // Hacim hatası kodu
                    'message' => 'Bu məhsul qutuya sığmır. Zəhmət olmasa daha kiçik məhsul seçin və ya başqa qutu seçin.'
                ]);
            }

            $item = ChooseItem::findOrFail($request->choose_item_id);

            $itemData = [
                'item_id' => $item->id,
                'item_name' => $item->name,
                'item_image' => $item->normal_image,
                'item_price' => $request->variant_price ?? $item->price,
                'selected_variant' => $request->selected_variant,
                'user_text' => $request->user_text,
                'uploaded_images' => []
            ];

            if ($request->hasFile('uploaded_images')) {
                foreach ($request->file('uploaded_images') as $image) {
                    $path = $image->store('custom-uploads', 'public');
                    $itemData['uploaded_images'][] = $path;
                }
            }

            $existingItems = Session::get('selected_item', []);
            if (!is_array($existingItems)) {
                $existingItems = [];
            }

            $existingItems[] = $itemData;
            Session::put('selected_item', $existingItems);

            Log::info(Session::get('selected_item'));


            return response()->json([
                'success' => true,
                'message' => 'Məhsul məlumatları saxlanıldı'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta: ' . $e->getMessage()
            ], 500);
        }
    }

    private function checkBoxVolume(Request $request)
    {
        try {
            Log::info('Request details:', [
                'request' => $request->all(),
                'session' => Session::all()
            ]);

            $selectedBox = Session::get('selected_box');
            if (!$selectedBox) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lütfen önce bir kutu seçin.'
                ]);
            }

            $box = BoxCategory::find($selectedBox['box_id']);
            if (!$box) {
                Log::error('Box not found', ['box_id' => $selectedBox['box_id']]);
                return response()->json([
                    'success' => false,
                    'message' => 'Kutu bulunamadı.'
                ]);
            }

            $boxVolume = $box->boxVolume;
            $selectedItems = Session::get('selected_item', []);

            $currentTotalVolume = 0;
            foreach ($selectedItems as $item) {
                $chooseItem = ChooseItem::find($item['item_id']);
                if ($chooseItem) {
                    $currentTotalVolume += $chooseItem->itemVolume;
                }
            }

            $newItem = ChooseItem::find($request->choose_item_id);
            if (!$newItem) {
                Log::error('Item not found', ['item_id' => $request->choose_item_id]);
                return response()->json([
                    'success' => false,
                    'message' => 'Ürün bulunamadı.'
                ]);
            }

            $newItemVolume = $newItem->itemVolume;
            $totalVolumeAfterAdd = $currentTotalVolume + $newItemVolume;

            Log::info('Volume calculations', [
                'box_volume' => $boxVolume,
                'current_total_volume' => $currentTotalVolume,
                'new_item_volume' => $newItemVolume,
                'total_after_add' => $totalVolumeAfterAdd
            ]);

            if ($totalVolumeAfterAdd > $boxVolume) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bu ürün kutuya sığmayacak kadar büyük. Lütfen daha küçük bir ürün seçin veya başka bir kutu seçin.',
                    'current_volume' => $currentTotalVolume,
                    'box_volume' => $boxVolume,
                    'new_item_volume' => $newItemVolume
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Ürün kutuya eklenebilir.',
                'current_volume' => $currentTotalVolume,
                'box_volume' => $boxVolume,
                'new_item_volume' => $newItemVolume,
                'remaining_volume' => $boxVolume - $totalVolumeAfterAdd
            ]);

        } catch (\Exception $e) {
            Log::error('Detailed error in checkBoxVolume', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }

    public function saveCardSelection(Request $request)
    {
        \Log::info('Card Selection Request:', $request->all());

        try {
            $card = Card::findOrFail($request->card_id);

            $cardData = [
                'card_id' => $card->id,
                'card_name' => $card->name,
                'card_image' => $card->image,
                'card_price' => $card->price,
                'recipient_name' => $request->recipient_name,
                'sender_name' => $request->sender_name,
                'card_message' => $request->card_message
            ];

            \Log::info('Saving card data:', $cardData);
            Session::put('selected_card', $cardData);
            \Log::info('Session after save:', Session::all());

            return response()->json([
                'success' => true,
                'message' => 'Kart məlumatları saxlanıldı'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in saveCardSelection:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Xəta: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getSelections()
    {
        $selections = [
            'box' => Session::get('selected_box'),
            'item' => Session::get('selected_item', []),
            'card' => Session::get('selected_card')
        ];

        $totalPrice = 0;

        if ($selections['box']) {
            $totalPrice += $selections['box']['box_price'] ?? 0;
        }

        if ($selections['item']) {
            foreach ($selections['item'] as $item) {
                $totalPrice += $item['item_price'] ?? 0;
            }
        }

        if ($selections['card']) {
            $totalPrice += $selections['card']['card_price'] ?? 0;
        }

        $selections['total_price'] = $totalPrice;

        return response()->json([
            'success' => true,
            'data' => $selections
        ]);
    }

    public function removeSelection(Request $request)
    {
        $type = $request->type;
        $index = $request->index;

        switch($type) {
            case 'box':
                Session::forget('selected_box');
                break;
            case 'item':
                if (Session::has('selected_item')) {
                    $items = Session::get('selected_item');
                    if (isset($items[$index])) {
                        unset($items[$index]);
                        $items = array_values($items); // Reindex array
                        Session::put('selected_item', $items);
                    }
                }
                break;
            case 'card':
                Session::forget('selected_card');
                break;
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed successfully'
        ]);
    }

    public function clearSelections()
    {
        Session::forget(['selected_box', 'selected_item', 'selected_card']);

        return response()->json([
            'success' => true,
            'message' => 'Bütün seçimlər silindi'
        ]);
    }

    public function getCurrentStep()
    {
        $step = 1; // Default step

        if (Session::has('selected_box')) {
            $step = 2;
        }

        if (Session::has('selected_item')) {
            $step = 3;
        }

        if (Session::has('selected_card')) {
            $step = 4;
        }

        return response()->json([
            'success' => true,
            'current_step' => $step
        ]);
    }


    public function saveToDatabase(Request $request)
    {
        try {
            DB::beginTransaction();

            $userId = auth()->id();
            $box = Session::get('selected_box');
            $items = Session::get('selected_item', []);
            $card = Session::get('selected_card');

            // Calculate total price
            $totalPrice = 0;
            if ($box) {
                $totalPrice += $box['box_price'] ?? 0;
            }
            foreach ($items as $item) {
                $totalPrice += $item['item_price'] ?? 0;
            }
            if ($card) {
                $totalPrice += $card['card_price'] ?? 0;
            }

            // Remove duplicate items
            $uniqueItems = array_map('unserialize', array_unique(array_map('serialize', $items)));

            $mainData = [
                'user_id' => $userId,
                'gift_box_id' => $box['box_id'] ?? null,
                'box_customization_text' => $box['customization_text'] ?? null,
                'selected_font' => $box['selected_font'] ?? null,
                'card_id' => $card['card_id'] ?? null,
                'recipient_name' => $card['recipient_name'] ?? null,
                'sender_name' => $card['sender_name'] ?? null,
                'card_message' => $card['card_message'] ?? null,
                'total_price' => $totalPrice, // Add total price to main data
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ];

            $mainRecordId = DB::table('user_card_for_build_a_box')->insertGetId($mainData);

            if (!empty($uniqueItems)) {
                foreach ($uniqueItems as $item) {
                    $selectedVariants = isset($item['selected_variant'])
                        ? (is_array($item['selected_variant'])
                            ? json_encode($item['selected_variant'])
                            : json_encode([$item['selected_variant']]))
                        : null;

                    $itemData = [
                        'user_card_id' => $mainRecordId,
                        'choose_item_id' => $item['item_id'],
                        'selected_variants' => $selectedVariants,
                        'user_text' => $item['user_text'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];

                    $itemId = DB::table('user_build_a_box_card_items')->insertGetId($itemData);

                    if (!empty($item['uploaded_images'])) {
                        foreach ($item['uploaded_images'] as $index => $imagePath) {
                            DB::table('build_a_box_item_images')->insert([
                                'user_build_a_box_card_item_id' => $itemId,
                                'choose_item_id' => $item['item_id'],
                                'image' => $imagePath,
                                'order' => $index,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                        }
                    }
                }
            }

            DB::commit();
            Session::forget(['selected_box', 'selected_item', 'selected_card']);

            return response()->json([
                'success' => true,
                'message' => 'Sifarişiniz səbətinizə əlavə edildi. Sifarişinizi tamamlamaq üçün səbətinizi ziyarət edin.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Database error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }

}
