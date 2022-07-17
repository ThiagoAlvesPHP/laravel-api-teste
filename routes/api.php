<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ProductsController;

Route::get('/ping', function () {
    return ["pong" => true];
});
/**
 * Brands
 */
Route::prefix('/brands')->group(function () {
    Route::get('/', [BrandsController::class, 'list']);
});
/**
 * Products
 */
Route::prefix('/products')->group(function () {
    Route::get('/find/{id}', [ProductsController::class, 'get']);
    Route::get('/list', [ProductsController::class, 'list']);
    Route::post('/create', [ProductsController::class, 'create']);
    Route::put('/update/{id}', [ProductsController::class, 'update']);
    Route::delete('/delete/{id}', [ProductsController::class, 'delete']);
});

