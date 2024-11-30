<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\RegisterController;





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








// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'store'])->name('register');






