<?php

namespace App\Http\Controllers;

use App\Models\CorporateGift;

class CorporateGiftController extends Controller
{

    public function index()
    {
        $corporateGifts = CorporateGift::all();

        return view('front.corporate_gifts', compact('corporateGifts'));
    }
}
