<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SellerController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Resources - CRUD Lengkap
Route::apiResource('sellers', SellerController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);

