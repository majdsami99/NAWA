<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\EnsureUserType;
use Illuminate\Routing\Controllers\Middleware;
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

//Route::middleware(['auth',EnsureUserType::class])->prefix('/admin')->group(function(){
    Route::middleware(['auth','auth.type:admin,super-admin'])->prefix('/admin')->group(function(){

Route::resource('/products', ProductController::class);
Route::get('/products/trashed',[ProductController::class,'trashed'])
->name('products.trashed')
->Middleware('auth');
 //من هنا جاءت فكرة الراوت قروب لانو رح استخدمها في كل راوت تقريبا
Route::put('/products/trashed/{product}/restore',[ProductController::class,'restore'])
->name('products.restore');
Route::delete('/products/{product}/force',[ProductController::class,'forceDelete'])
->name('products.force-Delete');
Route::resource('/categories', CategoryController::class);
});
//prefix رح ياخد لكل راوت /admin
//
//
