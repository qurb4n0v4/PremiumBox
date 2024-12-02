<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminDashboardController;






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

Route::middleware('guest:admin')->group(function () {
    // Qeydiyyat səhifəsi
    Route::get('admin/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('admin/register', [RegisterController::class, 'register']);

    // Giriş səhifəsi
    Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [LoginController::class, 'login']);
});

Route::middleware('auth:admin')->group(function () {
    // Admin ana səhifəsi
    Route::get('admin', [AdminController::class, 'index'])->name('admin');

    // Admin dashboard səhifəsi
//    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::get('/recover-password', function () {
    return view('admin.blade.php.dashboard.auth.recoverpw');
})->name('recover-password');



