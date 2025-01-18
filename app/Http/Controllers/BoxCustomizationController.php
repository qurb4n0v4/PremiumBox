<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\UserCardForBuildABox;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//
//class BoxCustomizationController extends Controller
//{
//    public function store(Request $request)
//    {
//        if (!$request->wantsJson()) {
//            return response()->json([
//                'success' => false,
//                'message' => 'JSON request required'
//            ], 400);
//        }
//
//        try {
//            \Log::info('Box customization request:', $request->all());
//
//            $validated = $request->validate([
//                'gift_box_id' => 'required|exists:gift_boxes,id',
//                'box_customization_text' => 'required|string|max:255',
//                'selected_font' => 'required|string|max:50'
//            ]);
//
//            $userId = Auth::check() ? Auth::id() : session()->getId();
//
//            $customization = new UserCardForBuildABox();
//            $customization->user_id = $userId;
//            $customization->gift_box_id = $request->gift_box_id;
//            $customization->box_customization_text = $request->box_customization_text;
//            $customization->selected_font = $request->selected_font;
//            $customization->status = 'pending';
//            $customization->save();
//
//            return response()->json([
//                'success' => true,
//                'message' => 'Customization saved successfully',
//                'redirect_url' => route('choose.step', 2)
//            ]);
//
//        } catch (\Exception $e) {
//            \Log::error('Box customization error:', [
//                'message' => $e->getMessage(),
//                'trace' => $e->getTraceAsString()
//            ]);
//
//            return response()->json([
//                'success' => false,
//                'message' => 'An error occurred: ' . $e->getMessage()
//            ], 500);
//        }
//    }
//}
