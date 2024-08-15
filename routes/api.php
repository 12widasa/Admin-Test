<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AddProductController;
use App\Http\Controllers\Api\ProductController;

//routes/api.php
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'CheckRole:sales'])->group(function () {
    Route::post('/add-penjualan', [AddProductController::class, 'addPenjualan']);
    Route::get('/products', [ProductController::class, 'index']); // Route untuk mendapatkan ID dan daftar produk
});