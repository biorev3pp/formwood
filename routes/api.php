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

// Species Operations
Route::post('create/species', [App\Http\Controllers\Admin\SpeciesController::class, 'store']);
Route::delete('delete/species', [App\Http\Controllers\Admin\SpeciesController::class, 'destroy']);
Route::post('update/species/{id}', [App\Http\Controllers\Admin\SpeciesController::class, 'update']);

// Qualities Operations
Route::post('create/qualities', [App\Http\Controllers\Admin\QualitiesController::class, 'store']);
Route::delete('delete/qualities', [App\Http\Controllers\Admin\QualitiesController::class, 'destroy']);
Route::post('update/qualities/{id}', [App\Http\Controllers\Admin\QualitiesController::class, 'update']);

// Cuts Operations
Route::post('create/cuts', [App\Http\Controllers\Admin\CutsController::class, 'store']);
Route::delete('delete/cuts', [App\Http\Controllers\Admin\CutsController::class, 'destroy']);
Route::post('update/cuts/{id}', [App\Http\Controllers\Admin\CutsController::class, 'update']);

// Matching Operations
Route::post('create/matchings', [App\Http\Controllers\Admin\MatchingsController::class, 'store']);
Route::delete('delete/matchings', [App\Http\Controllers\Admin\MatchingsController::class, 'destroy']);
Route::post('update/matchings/{id}', [App\Http\Controllers\Admin\MatchingsController::class, 'update']);

// Login Graph Operations

// Step 2 data
Route::get('get-cuts/{id}', [App\Http\Controllers\Admin\LogicController::class, 'getCuts']);
Route::post('update-species-cuts', [App\Http\Controllers\Admin\LogicController::class, 'updateSpeciesCuts']);

// Step 3 data
Route::get('get-qualities/{id}', [App\Http\Controllers\Admin\LogicController::class, 'getQualities']);
Route::post('update-species-qualities', [App\Http\Controllers\Admin\LogicController::class, 'updateSpeciesQualities']);

// Step 4 data
Route::get('get-matchings/{id}', [App\Http\Controllers\Admin\LogicController::class, 'getMatchings']);


// Step 5 data
Route::get('get-category-sizes/{id}', [App\Http\Controllers\Admin\LogicController::class, 'getCategorySizes']);


// Step 6 data
Route::get('get-panel-options/{id}', [App\Http\Controllers\Admin\LogicController::class, 'getPanelOptions']);


// Step 7 data
Route::get('get-backers/{id}', [App\Http\Controllers\Admin\LogicController::class, 'getBackers']);