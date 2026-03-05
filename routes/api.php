<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\User\MenuController;
use App\Http\Controllers\Api\User\OrderController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Api\Auth\AdminAuthController;
use App\Http\Controllers\Api\Admin\AdminDashboardController;
use App\Http\Controllers\Api\Admin\AdminMenuController;

//user
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

    Route::prefix('orders')->group(function () {
        Route::post('/', [OrderController::class, 'store']);
        Route::get('/', [OrderController::class, 'index']);
        Route::get('/my', [OrderController::class, 'myOrder']);
        Route::get('/{id}', [OrderController::class, 'show']);
        Route::post('/{order}/pay', [OrderController::class, 'pay']);
    });
});

//admin
Route::prefix('admin')->group(function () {

    Route::post('/register', [AdminAuthController::class, 'register']);
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);
        Route::apiResource('menus', AdminMenuController::class);
    });
});


