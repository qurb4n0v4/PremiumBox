<?php

namespace App\Http\Controllers;

use App\Models\GiftBox;
use App\Models\ChooseItem;
use App\Models\Card;
use Illuminate\Http\Request;
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

            // Handle file uploads if they exist
            if ($request->hasFile('uploaded_images')) {
                foreach ($request->file('uploaded_images') as $image) {
                    // Store the image and get the path
                    $path = $image->store('custom-uploads', 'public');
                    $itemData['uploaded_images'][] = $path;
                }
            }

            // Get existing items from session
            $existingItems = Session::get('selected_item', []);

            // Ensure it's an array
            if (!is_array($existingItems)) {
                $existingItems = [];
            }

            // Add new item data
            $existingItems[] = $itemData;

            // Update session
            Session::put('selected_item', $existingItems);

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
            $totalPrice += $selections['box']['box_price'];
        }

        if ($selections['item']) {
            $totalPrice += $selections['item']['item_price'];
        }

        if ($selections['card']) {
            $totalPrice += $selections['card']['card_price'];
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

            // Session məlumatlarını al
            $box = Session::get('selected_box');
            $items = Session::get('selected_item', []);
            $card = Session::get('selected_card');

            // Debug üçün session məlumatlarını log et
            Log::info('Session data:', [
                'box' => $box,
                'items' => $items,
                'card' => $card,
                'files' => $request->hasFile('uploaded_images') ? 'Has files' : 'No files'
            ]);

            // Əsas yazını əlavə et
            $mainData = [
                'user_id' => $userId,
                'gift_box_id' => $box['box_id'] ?? null,
                'box_customization_text' => $box['customization_text'] ?? null,
                'selected_font' => $box['selected_font'] ?? null,
                'card_id' => $card['card_id'] ?? null,
                'recipient_name' => $card['recipient_name'] ?? null,
                'sender_name' => $card['sender_name'] ?? null,
                'card_message' => $card['card_message'] ?? null,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ];

            $mainRecordId = DB::table('user_card_for_build_a_box')->insertGetId($mainData);

            // Items və şəkilləri saxla
            if (!empty($items)) {
                foreach ($items as $item) {
                    // Selected variants'ı JSON formatına çevir
                    $selectedVariants = null;
                    if (isset($item['selected_variant'])) {
                        $selectedVariants = is_array($item['selected_variant'])
                            ? json_encode($item['selected_variant'])
                            : json_encode([$item['selected_variant']]);
                    }

                    // Item məlumatlarını əlavə et
                    $itemData = [
                        'user_card_id' => $mainRecordId,
                        'choose_item_id' => $item['item_id'],
                        'selected_variants' => $selectedVariants,
                        'user_text' => $item['user_text'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];

                    $itemId = DB::table('user_build_a_box_card_items')->insertGetId($itemData);

                    // Şəkilləri emal et
                    if ($request->hasFile('uploaded_images')) {
                        $files = $request->file('uploaded_images');
                        foreach ($files as $index => $file) {
                            try {
                                // Faylı oxu və kontenti al
                                $imageContent = file_get_contents($file->getRealPath());

                                Log::info('Processing image file:', [
                                    'original_name' => $file->getClientOriginalName(),
                                    'size' => $file->getSize(),
                                    'mime' => $file->getMimeType()
                                ]);

                                if ($imageContent) {
                                    $inserted = DB::table('build_a_box_item_images')->insert([
                                        'user_build_a_box_card_item_id' => $itemId,
                                        'choose_item_id' => $item['item_id'],
                                        'image' => $imageContent,
                                        'order' => $index,
                                        'created_at' => now(),
                                        'updated_at' => now()
                                    ]);

                                    Log::info('Image insert result:', [
                                        'success' => $inserted,
                                        'item_id' => $item['item_id'],
                                        'image_index' => $index
                                    ]);
                                }
                            } catch (\Exception $e) {
                                Log::error('Item image processing error:', [
                                    'error' => $e->getMessage(),
                                    'item_id' => $item['item_id'],
                                    'file_name' => $file->getClientOriginalName()
                                ]);
                            }
                        }
                    } else {
                        Log::info('No uploaded images found for item:', [
                            'item_id' => $item['item_id']
                        ]);
                    }
                }
            }

            DB::commit();
            Session::forget(['selected_box', 'selected_item', 'selected_card']);

            return response()->json([
                'success' => true,
                'message' => 'Məlumatlar uğurla saxlanıldı'
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
