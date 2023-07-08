<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductControllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;

Route::get('/products/{product}', [ProductControllers::class, 'show'])
    ->name('shop.products.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/checkout', [checkoutController::class, 'create'])->name('checkout');
Route::post('/checkout', [checkoutController::class, 'store'])->name('cart.store');
Route::get('/checkout/thankyou', [checkoutController::class, 'success'])->name('checkout.success');
