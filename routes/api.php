<?php

use App\Http\Controllers\Api\{
    CategoryController,
    ProductController
};
use Illuminate\Support\Facades\Route;

Route::apiResource('/categories/{category}/products', ProductController::class);

Route::put('/categories/{uuid}', [CategoryController::class, 'update']);
Route::delete('/categories/{uuid}', [CategoryController::class, 'destroy']);
Route::get('/categories/{uuid}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/', function () {
    return response()->json(['message' => 'ola mundo']);
});
