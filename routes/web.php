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

    Route::get('/inquiries', [App\Http\Controllers\Admin\EnquiriesController::class, 'index'])->name('enquiries')->defaults('menu', 'enquiries');
    Route::post('/export-inquiries', [App\Http\Controllers\Admin\EnquiriesController::class, 'estimatesReport'])->name('estimatesReport')->defaults('menu', 'enquiries');
    
    Route::get('/analytics', [App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('analytics')->defaults('menu', 'analytics');

    // Components URLs
    Route::get('/components/species', [App\Http\Controllers\Admin\SpeciesController::class, 'index'])->name('species')->defaults('menu', 'components');
    Route::get('/components/product-categories', [App\Http\Controllers\Admin\ProductCategoriesController::class, 'index'])->name('product-categories')->defaults('menu', 'components');
    Route::get('/components/cuts', [App\Http\Controllers\Admin\CutsController::class, 'index'])->name('cuts')->defaults('menu', 'components');
    Route::get('/components/matchings', [App\Http\Controllers\Admin\MatchingsController::class, 'index'])->name('matchings')->defaults('menu', 'components');
    Route::get('/components/sizes', [App\Http\Controllers\Admin\SizesController::class, 'index'])->name('sizes')->defaults('menu', 'components');
    Route::get('/components/qualities', [App\Http\Controllers\Admin\QualitiesController::class, 'index'])->name('quality')->defaults('menu', 'components');
    Route::get('/components/backers', [App\Http\Controllers\Admin\BackersController::class, 'index'])->name('backers')->defaults('menu', 'components');
    Route::get('/components/panel-substrates', [App\Http\Controllers\Admin\PanelOptionsController::class, 'index'])->name('panel_options')->defaults('menu', 'components');
    Route::get('/components/core-thickness', [App\Http\Controllers\Admin\PanelOptionsController::class, 'thickness'])->name('core_thickness')->defaults('menu', 'components');
    
    // Logics
    Route::get('/logic-graph', [App\Http\Controllers\Admin\LogicController::class, 'index'])->name('logic-graph')->defaults('menu', 'logic-graph');

    // Profile and Settigns
    Route::get('/profile', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('profile')->defaults('menu', 'profile');
    Route::get('configurations', [App\Http\Controllers\Admin\SettingsController::class, 'configurations'])->name('configurations');
    Route::get('settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings');
    Route::post('settings/save', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('update-settings');
    
});
