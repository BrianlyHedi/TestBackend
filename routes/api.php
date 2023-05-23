<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryProductController;

Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);

Route::group(['middleware' => ['before' => 'jwt.verify']], function() {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{id}', [ProductController::class, 'show']);
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{id}',  [ProductController::class, 'update']);
    Route::delete('products/{id}',  [ProductController::class, 'destroy']);
    Route::get('category-products', [CategoryProductController::class, 'index']);
    Route::get('category-products/{id}', [CategoryProductController::class, 'show']);
    Route::post('category-products', [CategoryProductController::class, 'store']);
    Route::put('category-products/{id}',  [CategoryProductController::class, 'update']);
    Route::delete('category-products/{id}',  [CategoryProductController::class, 'destroy']);
});
