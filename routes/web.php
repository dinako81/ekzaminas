<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatController as C;
use App\Http\Controllers\ServiceController as P;
use App\Http\Controllers\MasterController as M;
use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\CartController as CART;
use App\Http\Controllers\OrderController as O;

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



Route::name('front-')->group(function () {
    Route::get('/', [F::class, 'index'])->name('index');
    // Route::get('/category/{cat}', [F::class, 'catColors'])->name('cat-colors');
    Route::get('/service/{service}', [F::class, 'showService'])->name('show-service');
    Route::get('/my-orders', [F::class, 'orders'])->name('orders')->middleware('role:admin|client');
    Route::get('/download/{order}', [F::class, 'download'])->name('download')->middleware('role:admin|client');
});

Route::prefix('cart')->name('cart-')->group(function () {
    Route::put('/add', [CART::class, 'add'])->name('add');
    Route::put('/rem', [CART::class, 'rem'])->name('rem');
    Route::put('/update', [CART::class, 'update'])->name('update');
    Route::post('/buy', [CART::class, 'buy'])->name('buy');
    Route::get('/', [CART::class, 'showCart'])->name('show');
    Route::get('/mini-cart', [CART::class, 'miniCart'])->name('mini-cart');
});

Route::prefix('cats')->name('cats-')->group(function () {
    Route::get('/', [C::class, 'index'])->name('index')->middleware('role:admin');
    Route::get('/create', [C::class, 'create'])->name('create')->middleware('role:admin');
    Route::post('/create', [C::class, 'store'])->name('store')->middleware('role:admin');
    Route::get('/{cat}', [C::class, 'show'])->name('show')->middleware('role:admin');
    Route::get('/edit/{cat}', [C::class, 'edit'])->name('edit')->middleware('role:admin');
    Route::put('/edit/{cat}', [C::class, 'update'])->name('update')->middleware('role:admin');
    Route::delete('/delete/{cat}', [C::class, 'destroy'])->name('delete')->middleware('role:admin');
});

Route::prefix('services')->name('services-')->group(function () {
    Route::get('/', [P::class, 'index'])->name('index')->middleware('role:admin|client');
    Route::get('/create', [P::class, 'create'])->name('create')->middleware('role:admin');
    Route::post('/create', [P::class, 'store'])->name('store')->middleware('role:admin');
    Route::get('/{service}', [P::class, 'show'])->name('show')->middleware('role:admin');
    Route::get('/edit/{service}', [P::class, 'edit'])->name('edit')->middleware('role:admin');
    Route::put('/edit/{service}', [P::class, 'update'])->name('update')->middleware('role:admin');
    Route::delete('/delete/{service}', [P::class, 'destroy'])->name('delete')->middleware('role:admin');
});

Route::prefix('masters')->name('masters-')->group(function () {
    Route::get('/', [M::class, 'index'])->name('index')->middleware('role:admin');
    Route::get('/create', [M::class, 'create'])->name('create')->middleware('role:admin');
    Route::post('/create', [M::class, 'store'])->name('store')->middleware('role:admin');
    Route::get('/edit/{master}', [M::class, 'edit'])->name('edit')->middleware('role:admin');
    Route::put('/edit/{master}', [M::class, 'update'])->name('update')->middleware('role:admin');
    Route::delete('/delete/{master}', [M::class, 'destroy'])->name('delete')->middleware('role:admin');
});

Route::prefix('orders')->name('orders-')->group(function () {
    Route::get('/', [O::class, 'index'])->name('index')->middleware('role:admin');
    Route::put('/status/{order}', [O::class, 'update'])->name('update')->middleware('role:admin');
    // Route::get('/create', [O::class, 'create'])->name('create')->middleware('role:admin');
    // Route::post('/create', [O::class, 'store'])->name('store')->middleware('role:admin');
    // Route::get('/edit/{cat}', [O::class, 'edit'])->name('edit')->middleware('role:admin');
    // Route::put('/edit/{cat}', [O::class, 'update'])->name('update')->middleware('role:admin');
    // Route::delete('/delete/{cat}', [O::class, 'destroy'])->name('delete')->middleware('role:admin');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');