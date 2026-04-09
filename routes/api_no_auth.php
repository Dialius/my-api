<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SellerController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

/**
 * ROUTES TANPA AUTHENTICATION
 * 
 * File ini untuk testing tanpa perlu login/token
 * Gunakan file ini jika teman-teman kesulitan dengan authentication
 * 
 * CARA PAKAI:
 * 1. Backup file routes/api.php
 * 2. Copy isi file ini ke routes/api.php
 * 3. Test di Postman tanpa perlu token
 * 
 * PENTING: Jangan gunakan di production!
 */

// Auth routes (optional - bisa dipakai atau tidak)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

// API Resources - TANPA AUTHENTICATION (untuk testing)
Route::apiResource('sellers', SellerController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);

// Test endpoint
Route::get('/test', function () {
    return response()->json([
        'success' => true,
        'message' => 'API is working!',
        'timestamp' => now(),
    ]);
});
