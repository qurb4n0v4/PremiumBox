<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Models\FAQ;
use App\Http\Controllers\CorporateGiftController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GiftBoxController;
use Illuminate\Support\Facades\Mail;




Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', function () {
    return view('front.about_us.about_us');
})->name('about_us');
Route::get('/contact-us', function () {
    return view('front.about_us.contact_us');
})->name('contact_us');
Route::get('/faqs', function () {
    $faqs = FAQ::all();
    return view('front.about_us.faq',  compact('faqs'));
})->name('faq');
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy_policy');
Route::get('/corporate-gifts', [CorporateGiftController::class, 'index'])->name('corporate-gifts');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');

    Route::get('/choose_a_box', [GiftBoxController::class, 'index'])->name('choose_a_box');


Route::get('/chat', function () {
    return view('front.chat');
})->name('chat');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

