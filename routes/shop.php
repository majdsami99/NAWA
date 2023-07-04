<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('shop.products.show');
    Route::get('/cart',[CartController::class,'index'])
    ->name('cart');
    Route::post('/cart',[CartController::class,'index'])
    ->name('cart');
    Route::delete('/cart/{id}',[CartController::class,'index'])
    ->name('cart.destroy');

