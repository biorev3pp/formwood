<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Product Category Operations
Route::post('create/product-category', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'store']);
Route::delete('delete/product-category', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'destroy']);
Route::post('update/product-category/{id}', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'update']);
Route::post('bulk/product-category', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'bulkAction']);

// Product Sizes Operations
Route::post('create/product-size', [App\Http\Controllers\Admin\SizesController::class, 'store']);
Route::delete('delete/product-size', [App\Http\Controllers\Admin\SizesController::class, 'destroy']);
Route::post('update/product-size/{id}', [App\Http\Controllers\Admin\SizesController::class, 'update']);
Route::post('bulk/product-size', [App\Http\Controllers\Admin\SizesController::class, 'bulkAction']);

// Species Operations
Route::post('create/species', [App\Http\Controllers\Admin\SpeciesController::class, 'store']);
Route::delete('delete/species', [App\Http\Controllers\Admin\SpeciesController::class, 'destroy']);
Route::post('update/species/{id}', [App\Http\Controllers\Admin\SpeciesController::class, 'update']);
Route::post('bulk/species', [App\Http\Controllers\Admin\SpeciesController::class, 'bulkAction']);

// Qualities Operations
Route::post('create/qualities', [App\Http\Controllers\Admin\QualitiesController::class, 'store']);
Route::delete('delete/qualities', [App\Http\Controllers\Admin\QualitiesController::class, 'destroy']);
Route::post('update/qualities/{id}', [App\Http\Controllers\Admin\QualitiesController::class, 'update']);
Route::post('bulk/qualities', [App\Http\Controllers\Admin\QualitiesController::class, 'bulkAction']);

// Cuts Operations
Route::post('create/cuts', [App\Http\Controllers\Admin\CutsController::class, 'store']);
Route::delete('delete/cuts', [App\Http\Controllers\Admin\CutsController::class, 'destroy']);
Route::post('update/cuts/{id}', [App\Http\Controllers\Admin\CutsController::class, 'update']);
Route::post('bulk/cuts', [App\Http\Controllers\Admin\CutsController::class, 'bulkAction']);

// Matching Operations
Route::post('create/matchings', [App\Http\Controllers\Admin\MatchingsController::class, 'store']);
Route::delete('delete/matchings', [App\Http\Controllers\Admin\MatchingsController::class, 'destroy']);
Route::post('update/matchings/{id}', [App\Http\Controllers\Admin\MatchingsController::class, 'update']);
Route::post('bulk/matchings', [App\Http\Controllers\Admin\MatchingsController::class, 'bulkAction']);

// Panel Substrate Operations
Route::post('create/substrate', [App\Http\Controllers\Admin\PanelOptionsController::class, 'storeSubstrate']);
Route::delete('delete/substrate', [App\Http\Controllers\Admin\PanelOptionsController::class, 'destroySubstrate']);
Route::post('update/substrate/{id}', [App\Http\Controllers\Admin\PanelOptionsController::class, 'updateSubstrate']);
Route::post('bulk/substrate', [App\Http\Controllers\Admin\PanelOptionsController::class, 'bulkActionSubstrate']);

// Panel Thickness Operations
Route::post('create/thickness', [App\Http\Controllers\Admin\PanelOptionsController::class, 'storeThickness']);
Route::delete('delete/thickness', [App\Http\Controllers\Admin\PanelOptionsController::class, 'destroyThickness']);
Route::post('update/thickness/{id}', [App\Http\Controllers\Admin\PanelOptionsController::class, 'updateThickness']);
Route::post('bulk/thickness', [App\Http\Controllers\Admin\PanelOptionsController::class, 'bulkActionThickness']);

// Backers Operations
Route::post('create/backer', [App\Http\Controllers\Admin\BackersController::class, 'store']);
Route::delete('delete/backer', [App\Http\Controllers\Admin\BackersController::class, 'destroy']);
Route::post('update/backer/{id}', [App\Http\Controllers\Admin\BackersController::class, 'update']);
Route::post('bulk/backer', [App\Http\Controllers\Admin\BackersController::class, 'bulkAction']);


// Login Graph Operations

// Step 2 data
Route::get('get-cuts/{id}', [App\Http\Controllers\Admin\LogicController::class, 'getCuts']);
Route::post('update-species-cuts', [App\Http\Controllers\Admin\LogicController::class, 'updateSpeciesCuts']);

// Step 3 data
Route::get('get-qualities/{id}', [App\Http\Controllers\Admin\LogicController::class, 'getQualities']);
Route::post('update-species-qualities', [App\Http\Controllers\Admin\LogicController::class, 'updateSpeciesQualities']);

// Step 4 data
Route::get('get-matchings/{id}', [App\Http\Controllers\Admin\LogicController::class, 'getMatchings']);
Route::post('update-cut-matchings', [App\Http\Controllers\Admin\LogicController::class, 'updateCutMatchings']);

// Step 5 data
Route::get('get-category-sizes', [App\Http\Controllers\Admin\LogicController::class, 'getCategorySizes']);


// Step 6 data
Route::get('get-panel-options', [App\Http\Controllers\Admin\LogicController::class, 'getPanelOptions']);
Route::get('get-core-thickness/{id}', [App\Http\Controllers\Admin\LogicController::class, 'getPanelThickness']);
Route::post('update-panel-thickness', [App\Http\Controllers\Admin\LogicController::class, 'updatePanelThickness']);


// Step 7 data
Route::get('get-backers/{id}', [App\Http\Controllers\Admin\LogicController::class, 'getBackers']);
Route::post('update-size-backers', [App\Http\Controllers\Admin\LogicController::class, 'updateSizeBackers']);
