<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;


class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        return view('front.home', compact('slides'));
    }
}
