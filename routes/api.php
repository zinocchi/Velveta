<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Shop\MenuController;
use App\Http\Controllers\Api\Shop\OrderController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', fn(Request $request) => response()->json([
        'user' => $request->user()
    ]));

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('menu')->group(function () {
    Route::get('/', [MenuController::class, 'index']);
    Route::get('/categories', [MenuController::class, 'categories']);
    Route::get('/category/{slug}', [MenuController::class, 'byCategory']);
    Route::get('/{id}', [MenuController::class, 'show']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/orders', [OrderController::class, 'store']);
    Route::post('/orders/{order}/pay', [OrderController::class, 'pay']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/my', [OrderController::class, 'MyOrders']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'admin'])
  ->patch('/orders/{id}/status', [OrderController::class, 'updateStatus']);

