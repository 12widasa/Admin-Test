<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('export')->group(function () {
    Route::get('users', [ExportController::class, 'exportUsers']);
    Route::get('products', [ExportController::class, 'exportProducts']);
});