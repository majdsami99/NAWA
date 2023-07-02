<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('shop.products.show');
