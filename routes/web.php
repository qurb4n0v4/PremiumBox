<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PrivacyPolicyController;






Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', function () {
    return view('front.about_us.about_us');
})->name('about_us');
Route::get('/contact-us', function () {
    return view('front.about_us.contact_us');
})->name('contact_us');
Route::get('/faq', function () {
    return view('front.about_us.faq');
})->name('faq');
Route::get('/privacy-policy', function () {
    return view('front.about_us.privacy_policy');
})->name('privacy_policy');





