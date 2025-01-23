<?php

use App\Http\Controllers\BoxCustomizationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SessionController;
use Filament\Facades\Filament;
use App\Http\Controllers\PremadeBoxController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Models\FAQ;
use App\Http\Controllers\CorporateGiftController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GiftBoxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;

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

Route::get('/choose_premade_box', [PremadeBoxController::class, 'index'])->name('choose_premade_box');
Route::get('/customize_premade_box/{id?}', [PremadeBoxController::class, 'show'])->name('customize_premade_box');
Route::get('/customize_premade_box/{id}', [CardController::class, 'index']);
Route::post('/cards', [CardController::class, 'store'])->name('cards.store');
Route::get('/done_premade', [PremadeBoxController::class, 'done'])->name('done_premade');

Route::get('/choose-items', [GiftBoxController::class, 'chooseItems'])->name('choose.items');
Route::get('/choose-step/{step}', [GiftBoxController::class, 'chooseStep'])->name('choose.step');
Route::get('/choose-card', [GiftBoxController::class, 'chooseCard'])->name('choose.card');
Route::get('/order-complete', [GiftBoxController::class, 'orderComplete'])->name('order.complete');

Route::prefix('session')->group(function () {
    Route::post('/save-box', [SessionController::class, 'saveBoxSelection']);
    Route::post('/save-item', [SessionController::class, 'saveItemSelection']);
    Route::post('/save-card', [SessionController::class, 'saveCardSelection']);
    Route::get('/get-selections', [SessionController::class, 'getSelections']);
    Route::post('/clear', [SessionController::class, 'clearSelections']);
    Route::get('/current-step', [SessionController::class, 'getCurrentStep']);
    Route::post('/remove-selection', [SessionController::class, 'removeSelection'])->name('remove.selection');
});
Route::post('/remove-selection', [App\Http\Controllers\SessionController::class, 'removeSelection'])->name('remove.selection');
Route::post('/save-card-selection', [SessionController::class, 'saveCardSelection']);
Route::post('/upload-images', [SessionController::class, 'handleFileUpload']);
Route::post('/save-to-database', [SessionController::class, 'saveToDatabase'])->name('save.to.database');
Route::get('/session/check-box', function () {
    return response()->json([
        'has_box' => session()->has('selected_box'),
    ]);
});


Route::get('/chat', function () {
    return view('front.chat');
})->name('chat');

//user
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/front/user/profile', [UserProfileController::class, 'index'])->name('profile');
Route::get('/front/user/profile/details', [UserProfileController::class, 'showProfile'])->name('profile-details');
//Route::get('/front/user/orders', [UserProfileController::class, 'showOrders'])->name('orders')->middleware('auth');
Route::get('/front/user/coupons', [UserProfileController::class, 'showCoupons'])->name('coupons');
Route::put('/front/user/profile/update', [UserProfileController::class, 'updateProfile'])->name('profile-update');
Route::get('/front/user/profile/edit', [UserProfileController::class, 'editProfile'])->name('profile-edit');

Route::middleware('auth')->group(function () {
    Route::get('/front/user/addresses', [AddressController::class, 'index'])->name('addresses.index');
    Route::post('/front/user/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::get('/user/addresses/{address}/edit', [AddressController::class, 'edit'])->name('addresses.edit');
    Route::put('/user/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/user/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout'); // Siparişi Tamamla
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index'); // Siparişleri Göster
});

Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::middleware('auth')->get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::prefix('box')->group(function () {
    // Qutu seçimini saxla
    Route::post('/save-box-selection', [SessionController::class, 'saveBoxSelection'])->name('box.saveBoxSelection');

    Route::post('/check-box-volume', [SessionController::class, 'checkBoxVolume']);

    // Məhsul seçimini saxla
    Route::post('/save-item-selection', [SessionController::class, 'saveItemSelection'])->name('box.saveItemSelection');

    // Kart seçimini saxla
    Route::post('/save-card-selection', [SessionController::class, 'saveCardSelection'])->name('box.saveCardSelection');

    // Seçilmiş məlumatları al
    Route::get('/selections', [SessionController::class, 'getSelections'])->name('box.getSelections');

    // Seçimi sil
    Route::post('/remove-selection', [SessionController::class, 'removeSelection'])->name('box.removeSelection');

    // Bütün seçimləri sil
    Route::post('/clear-selections', [SessionController::class, 'clearSelections'])->name('box.clearSelections');

    // Cari addımı al
    Route::get('/current-step', [SessionController::class, 'getCurrentStep'])->name('box.getCurrentStep');

    // Seçilmiş məlumatları bazaya saxla
    Route::post('/save-to-database', [SessionController::class, 'saveToDatabase'])->name('box.saveToDatabase');
});


Route::post('/premade/store', [PremadeBoxController::class, 'store'])->name('premade.store');
