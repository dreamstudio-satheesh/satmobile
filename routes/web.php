<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\LoginController;

route::get('/offline.html', function () {
    return view('offline');
});

route::get('/login.html', function () {
    return view('auth.login');
});

Route::get('/auth/logout', [LoginController::class, 'authlogout'])->name('auth.logout');

Auth::routes([
    'register' => false, // Register Routes...

    'reset' => false, // Reset Password Routes...

    'verify' => false, // Email Verification Routes...
]);

// route group middleware auth
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home.html', [HomeController::class, 'index'])->name('index');

    Route::get('/cart.html', [HomeController::class, 'cart'])->name('cart');

    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

    // get rounte for invoice
    Route::get('/invoice/{id}', [HomeController::class, 'invoice'])->name('invoice');

    Route::get('/settings.html', [HomeController::class, 'settings'])->name('settings');
    Route::post('/selectline', [HomeController::class, 'selectline'])->name('selectline');
});

// routes/web.php
