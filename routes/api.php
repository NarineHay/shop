<?php

use App\Http\Controllers\Api\Cart\CartController;
use App\Http\Controllers\Api\Products\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/cart', [CartController::class, 'index']);
//     Route::post('/cart', [CartController::class, 'store']);
//     Route::post('/cart/merge', [CartController::class, 'merge']);

//     Route::patch('/cart/items/{item}/increase', [CartController::class, 'increase']);
//     Route::patch('/cart/items/{item}/decrease', [CartController::class, 'decrease']);
//     Route::delete('/cart/items/{item}', [CartController::class, 'remove']);
// });

Route::post('/products/prices', [ProductController::class, 'getPrices']); // цены для localStorage корзины
