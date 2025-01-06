<?php

use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Models\FAQ;
use App\Http\Controllers\CorporateGiftController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GiftBoxController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', function () {
    return view('front.about_us.about_us');
})->name('about_us');
Route::get('/contact-us', function () {
    return view('front.about_us.contact_us');
})->name('contact_us');
Route::get('/faqs', function () {
    $faqs = FAQ::all();
    return view('front.about_us.faq', compact('faqs'));
})->name('faq');
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy_policy');
Route::get('/corporate-gifts', [CorporateGiftController::class, 'index'])->name('corporate-gifts');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/choose_a_box', [GiftBoxController::class, 'index'])->name('choose_a_box');

Route::get('/chat', function () {
    return view('front.chat');
})->name('chat');

//user
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/front/user/profile', [UserProfileController::class, 'index'])->name('profile');
Route::get('/front/user/profile/details', [UserProfileController::class, 'showProfile'])->name('profile-details');
Route::get('/front/user/orders', [UserProfileController::class, 'showOrders'])->name('orders');
Route::get('/front/user/addresses', [UserProfileController::class, 'showAddressList'])->name('address-list');
Route::get('/front/user/coupons', [UserProfileController::class, 'showCoupons'])->name('coupons');




