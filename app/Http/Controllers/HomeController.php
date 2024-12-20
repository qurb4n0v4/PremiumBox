<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Box;
use App\Models\Partner;
use App\Models\MediaItem;
use App\Models\GiftSet;
use App\Models\PopUpHome;





class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        $boxes = Box::all();
        $partners = Partner::all();
        $mediaItems = MediaItem::all();
        $giftSets = GiftSet::all();
        $popUpHome = PopUpHome::first();

        return view('front.home', compact('slides', 'boxes', 'partners', 'mediaItems', 'giftSets', 'popUpHome'));
    }
}
