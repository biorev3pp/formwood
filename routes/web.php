<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend');
})->where('any', '.*');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function () { 

    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('home')->defaults('menu', 'dashboard');

    Route::get('/cropper', [App\Http\Controllers\Admin\CropperController::class, 'index'])->name('cropper')->defaults('menu', 'cropper');
    Route::post('/crop-image-upload', [App\Http\Controllers\Admin\CropperController::class, 'upload'])->name('cropper-upload')->defaults('menu', 'cropper');

    // Components URLs
    Route::get('/components/speceis', [App\Http\Controllers\Admin\SpeceisController::class, 'index'])->name('speceis')->defaults('menu', 'components');
    Route::get('/components/product-categories', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'index'])->name('product-categories')->defaults('menu', 'components');
    Route::get('/components/cuts', [App\Http\Controllers\Admin\CutsController::class, 'index'])->name('cuts')->defaults('menu', 'components');
    Route::get('/components/matching', [App\Http\Controllers\Admin\MatchingsController::class, 'index'])->name('matching')->defaults('menu', 'components');
    Route::get('/components/sizes', [App\Http\Controllers\Admin\SizesController::class, 'index'])->name('sizes')->defaults('menu', 'components');
    Route::get('/components/qualities', [App\Http\Controllers\Admin\QualitiesController::class, 'index'])->name('quality')->defaults('menu', 'components');
    Route::get('/components/backers', [App\Http\Controllers\Admin\BackersController::class, 'index'])->name('backers')->defaults('menu', 'components');
    Route::get('/components/panel-options', [App\Http\Controllers\Admin\PanelOptionsController::class, 'index'])->name('panel_options')->defaults('menu', 'components');
    
   
    // Profile and Settigns
    Route::get('/profile', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('profile')->defaults('menu', 'profile');
    Route::get('settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings');
    Route::post('settings/save', [App\Http\Controllers\Admin\SettingsController::class, 'update']);
    
});
