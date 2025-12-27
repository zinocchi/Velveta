<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', fn(Request $request) => [
        'user' => $request->user()
    ]);

    Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
        return response()->json([
            'user' => $request->user()
        ]);
    });


    Route::post('/logout', [AuthController::class, 'logout']);
});
