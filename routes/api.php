<?php

use App\Http\Controllers\Api\{
    CategoryController
};
use Illuminate\Support\Facades\Route;

Route::get('/categories/{uuid}', [CategoryController::class, 'show']);

Route::post('/categories', [CategoryController::class, 'store']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/', function () {
    return response()->json(['message' => 'ola mundo']);
});
