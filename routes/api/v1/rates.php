<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\Currency\CurrencyController;

/*
|--------------------------------------------------------------------------
| Currency Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->prefix('currencies')->name('currencies.')->group(function () {
    Route::get('', [CurrencyController::class, 'index'])->name('list');
    Route::prefix('{currency:num_code}')->name('currencies.')->group(function () {
        Route::get('', [CurrencyController::class, 'show'])->name('show');
    });
});
