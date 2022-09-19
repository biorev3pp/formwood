<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Product Category Operations
Route::post('create/product-category', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'store']);
Route::delete('delete/product-category', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'destroy']);
Route::post('update/product-category/{id}', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'update']);

// Product Sizes Operations
Route::post('create/product-size', [App\Http\Controllers\Admin\SizesController::class, 'store']);
Route::delete('delete/product-size', [App\Http\Controllers\Admin\SizesController::class, 'destroy']);
Route::post('update/product-size/{id}', [App\Http\Controllers\Admin\SizesController::class, 'update']);

// Speceis Operations
Route::post('create/speceis', [App\Http\Controllers\Admin\SpeceisController::class, 'store']);
Route::delete('delete/speceis', [App\Http\Controllers\Admin\SpeceisController::class, 'destroy']);
Route::post('update/speceis/{id}', [App\Http\Controllers\Admin\SpeceisController::class, 'update']);