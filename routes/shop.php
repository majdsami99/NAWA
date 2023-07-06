<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('shop.products.show');
    Route::get('/cart',[CartController::class,'index']) ->name('cart');
    Route::post('/cart',[CartController::class,'store'])  ->name('cart.store');
    Route::delete('/cart/{id}',[CartController::class,'destroy'])->name('cart.destroy');
    Route::get('/checkout',[checkController::class,'create']) ->name('checkout');
    Route::post('/checkout',[checkController::class,'store'])  ->name('cart.store');
    Route::get('/checkout/thankyou',[checkController::class,'success']) ->name('checkout.success');



