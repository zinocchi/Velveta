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
use App\Http\Controllers\Api\Admin\AdminOrderController;

//user auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', fn(Request $request) => response()->json([
        'user' => $request->user()
    ]));
    Route::post('/logout', [AuthController::class, 'logout']);
});

//show menu
Route::prefix('menu')->group(function () {
    Route::get('/', [MenuController::class, 'index']);
    Route::get('/categories', [MenuController::class, 'categories']);
    Route::get('/category/{slug}', [MenuController::class, 'byCategory']);
    Route::get('/{id}', [MenuController::class, 'show']);
});

//user routes
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('orders')->group(function () {
        Route::post('/', [OrderController::class, 'store']);
        Route::get('/', [OrderController::class, 'index']);
        Route::get('/my', [OrderController::class, 'myOrder']);
        Route::get('/{id}', [OrderController::class, 'show']);
        Route::post('/{order}/pay', [OrderController::class, 'pay']);
    });
});

//admin routes
Route::prefix('admin')->group(function () {
    Route::post('/register', [AdminAuthController::class, 'register']);
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::get('/login-status', [AdminAuthController::class, 'checkLoginStatus']);

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout']);

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);
        Route::get('/dashboard/revenue-report', [AdminDashboardController::class, 'getRevenueReport']);

        // Menu Management
        Route::apiResource('menus', AdminMenuController::class);
        Route::post('/menus/bulk-update-stock', [AdminMenuController::class, 'bulkUpdateStock']);
        Route::put('/menus/{id}/stock', [AdminMenuController::class, 'updateStock']);
        Route::get('/stock/low-stock', [AdminMenuController::class, 'getLowStockItems']);
        Route::get('/categories', [AdminMenuController::class, 'getCategories']);
        Route::patch('/menus/{id}/toggle-availability', [AdminMenuController::class, 'toggleAvailability']);

        // Order Management
        Route::get('/orders', [AdminOrderController::class, 'index']);
        Route::get('/orders/{id}', [AdminOrderController::class, 'show']);
        Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus']);
        Route::post('/orders/bulk-status', [AdminOrderController::class, 'bulkUpdateStatus']);
        Route::get('/orders/statistics/overview', [AdminOrderController::class, 'getStatistics']);
        Route::get('/orders/recent/recent-list', [AdminOrderController::class, 'getRecentOrders']);
        Route::get('/dashboard/revenue-report', [AdminDashboardController::class, 'getRevenueReport']);


        // Route::post('/generate-pin', [AdminAuthController::class, 'generateWorkPin']);
        // Route::get('/available-pins', [AdminAuthController::class, 'getAvailableWorkPins']);
    });
});
