<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;

// Route::resource('products',           ProductController::class);

//Public routes
Route::post('/register',               [AuthController::class, 'register']);
Route::get('/products',                [ProductController::class, 'index']);
Route::get('/products/{id}',           [ProductController::class, 'show']);
Route::get('/products/search/{name}',  [ProductController::class, 'search']);

//Protected Routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/products',       [ProductController::class, 'store']);
    Route::put('/products/{id}',   [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'delete']);
});
