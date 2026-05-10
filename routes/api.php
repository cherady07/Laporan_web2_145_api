<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('brands', BrandController::class);
Route::apiResource('products', ProductController::class);