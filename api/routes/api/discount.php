<?php

use App\Http\Controllers\DiscountController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum','role:admin'])->get('/discount-products', [DiscountController::class, 'index'])->name('products.index');