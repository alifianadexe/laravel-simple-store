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




// Admin & Staff Routes
Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => ['auth']], function() {

    Route::get('/', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');

    // Route::resource('/transactions', \App\Http\Controllers\TransactionController::class);
    Route::get('/report', [\App\Http\Controllers\TransactionController::class, 'report'])->name('report');

    Route::resource('/transactions', \App\Http\Controllers\TransactionsController::class);
    Route::resource('/serialnumber', \App\Http\Controllers\SerialNumberController::class);
   
    Route::resource('/barang', \App\Http\Controllers\BarangController::class);
    Route::resource('/users', \App\Http\Controllers\UserController::class);
});

Auth::routes();

