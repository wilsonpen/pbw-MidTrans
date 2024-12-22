<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrasiTiket;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/list-product', [ProductController::class, 'search']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('cart', CartController::class);
    Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

Route::get('/list', [RegistrasiTiket::class, 'index'])->middleware('khususUser');
Route::GET('/registrasi', [RegistrasiTiket::class, 'create'])->middleware('khususUser');

Route::POST('/registrasi', [RegistrasiTiket::class, 'store'])->middleware('khususUser');


Route::get("/ticket", [RegistrasiTiket::class, 'rota'])->middleware('khususUser');
Route::post('/payment/midtrans-callback', [PaymentController::class, 'midtransCallback']);
require __DIR__.'/auth.php';
