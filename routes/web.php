<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {
    Route::resource('offers', App\Http\Controllers\OfferController::class)->middleware('auth');
    Route::get('/MyOffers', [App\Http\Controllers\OfferController::class, 'MyOffers'])->name('offers.MyOffers');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
