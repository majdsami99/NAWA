<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

//  ABOOD

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/products', [ProductController::class, 'index']);
// Route::get('/admin/products', [ProductController::class, 'create']);

// Route::post('/admin/products', [ProductController::class, 'store']);
// Route::get('/admin/products', [ProductController::class, 'show']);

// Route::get('/admin/products', [ProductController::class, 'edit']);
// Route::put('/admin/products', [ProductController::class, 'update']);

// Route::delete('/admin/products', [ProductController::class, 'destroy']);

Route::resource('/admin/products', ProductController::class);
Route::resource('/admin/categories', CategoryController::class);


//
//
