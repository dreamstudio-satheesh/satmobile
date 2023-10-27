<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/settings.html', function(){
    return view('settings');
})->middleware(Authenticate::class);

route::get('/offline.html', function(){
    return view('offline');
});


route::get('/login.html', function(){
    return view('auth.login');
});


Route::get('/logout',  [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Auth::routes([

    'register' => false, // Register Routes...
  
    'reset' => false, // Reset Password Routes...
  
    'verify' => false, // Email Verification Routes...
  
  ]);


Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home.html', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/cart.html', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');
