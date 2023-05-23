<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('cart', [CartController::class, 'addToCart']);
    Route::delete('cart', [CartController::class, 'removeFromCart']);
    Route::get('cart', [CartController::class, 'getCartItems']);
});
