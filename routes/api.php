<?php

use App\Http\Controllers\api\{AdController, CategoryController, EstablishmentController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{App, Route,};

// Auth route
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Category Routes
Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('category.index');
    Route::post('/category/store', 'store')->name('category.store');
    Route::post('/subcategory/store/{category}', 'storeSubcategory')->name('subcategory.store');
    Route::get('/category/{category}', 'show')->name('category.show');
    Route::patch('/category/update/{category}', 'update')->name('category.update');
    Route::patch('/subcategory/update/{subcategory}', 'updateSubcategory')->name('subcategory.store');
    Route::delete('/category/delete/{category}', 'destroy')->name('category.delete');
    Route::delete('/subcategory/delete/{subcategory}', 'destroySubcategory')->name('subcategory.delete');
});

//Ad Routes
Route::controller(AdController::class)->group(function () {
    Route::get('/ads', 'index')->name('ad.index');
    Route::post('/ad/create', 'store')->name('ad.store');
    Route::get('/ad/{ad}', 'show')->name('ad.show');
    Route::patch('/ad/update/{ad}', 'update')->name('ad.update');
    Route::delete('/ad/delete/{ad}', 'delete')->name('ad.delete');
});

//Establishment Routes
Route::controller(EstablishmentController::class)->group(function () {
    Route::post('/establishment/create', 'store')->name('establishment.store');
    Route::get('/establishment/{establishment}', 'show')->name('establishment.show');
    Route::patch('/establishment/update/{establishment}', 'update')->name('establishment.update');
});


Route::get('/swagger', fn() => App::isProduction() ? response(status: 403) : view('swagger'))->name('swagger');
