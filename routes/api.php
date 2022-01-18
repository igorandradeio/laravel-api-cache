<?php

use App\Http\Controllers\Api\{
    CategoryController,
    ProductController,
    ResourceController
};
use App\Http\Controllers\Auth\AuthApiController;
use Illuminate\Support\Facades\Route;

/** User login */
Route::post('/auth', [AuthApiController::class, 'authenticate']);

//Auth Routes
Route::middleware(['apiJWT'])->group(function () {
    /** User authenticated information */
    Route::get('/me', [AuthApiController::class, 'getAuthenticatedUser']);
    /** Refresh user Token */
    Route::post('/auto-refresh', [AuthApiController::class, 'refreshToken']);
    /** Product routes */
    Route::post('/logout', [AuthApiController::class, 'logout']);
    /** Product routes */
    Route::apiResource('/categories/{category}/products', ProductController::class);
    /** Update category by uuid*/
    Route::put('/categories/{uuid}', [CategoryController::class, 'update']);
    /** Delete category by uuid*/
    Route::delete('/categories/{uuid}', [CategoryController::class, 'destroy']);
    /** Get category by uuid*/
    Route::get('/categories/{uuid}', [CategoryController::class, 'show']);
    /** Create category */
    Route::post('/categories', [CategoryController::class, 'store']);
    /** Get all categories */
    Route::get('/categories', [CategoryController::class, 'index']);
    /** Get all resources */
    Route::get('/resources', [ResourceController::class, 'index']);
});

Route::get('/', function () {
    return response()->json(['message' => 'Hello world']);
});
