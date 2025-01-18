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
                'item_image' => $item->image,
                'item_price' => $item->price,
                'selected_variants' => $request->selected_variants,
                'user_text' => $request->user_text
            ];

            // Sessiyadakı 'selected_item' məlumatını alırıq
            $existingItems = Session::get('selected_item', []);

            // Əgər 'selected_item' bir array deyilsə, bunu array olaraq dəyişirik
            if (!is_array($existingItems)) {
                $existingItems = []; // Yalnız array olsun deyə təmizləyirik
            }

            // Yeni itemData məlumatını əlavə edirik
            $existingItems[] = $itemData;

            // 'selected_item' sessiyasına yeni məlumatları əlavə edirik
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
