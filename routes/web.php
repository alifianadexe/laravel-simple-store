<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Customer Routes
Route::group(['middleware'=> ['auth']], function () {
    Route::get('/', [\App\Http\Controllers\CustomerController::class, 'home'])->name('home');
    Route::match(['GET', 'POST'], '/cart', [\App\Http\Controllers\CustomerController::class, 'cart'])->name('cart');
    Route::match(['GET', 'POST'], '/transactions', [\App\Http\Controllers\CustomerController::class, 'transactions'])->name('transactions');
    Route::get('/category/{category1?}/{category2?}/{category3?}/{category4?}/{category5?}', [\App\Http\Controllers\CustomerController::class, 'category'])->name('category');
    Route::get('/brand/{brand}', [\App\Http\Controllers\CustomerController::class, 'brand'])->name('brand');
});


// Admin & Staff Routes
Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => ['auth']], function() {

    Route::get('/', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('/transactions', \App\Http\Controllers\TransactionController::class);
    Route::get('/report', [\App\Http\Controllers\TransactionController::class, 'report'])->name('report');

    Route::resource('/products', \App\Http\Controllers\ProductController::class);
    Route::resource('/customers', \App\Http\Controllers\CustomerController::class);
    Route::resource('/categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('/brands', \App\Http\Controllers\BrandController::class);
    Route::resource('/users', \App\Http\Controllers\UserController::class);
});

Auth::routes();

