<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Box;



class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        $boxes = Box::all();

        return view('front.home', compact('slides', 'boxes'));
    }
}
