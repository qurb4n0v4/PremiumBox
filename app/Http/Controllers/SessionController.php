<?php

namespace App\Http\Controllers;

use App\Models\GiftBox;
use App\Models\ChooseItem;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

            Session::put('selected_card', $cardData);

            return response()->json([
                'success' => true,
                'message' => 'Kart məlumatları saxlanıldı'
            ]);
        } catch (\Exception $e) {
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
}
