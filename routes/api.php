<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Public endpoints (no authentication required)
    Route::get('/products/public', [ProductController::class, 'publicIndex']);
    Route::get('/products/public/{id}', [ProductController::class, 'publicShow']);

    // Protected endpoints (require authentication)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/products', [ProductController::class, 'index']);
        Route::get('/products/{id}', [ProductController::class, 'show']);
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    });
});
