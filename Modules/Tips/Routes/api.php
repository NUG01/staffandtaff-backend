<?php

use Illuminate\Support\Facades\Route;
use Modules\Tips\Http\Controllers\api\{CategoryController, TipController};

Route::controller(TipController::class)->group(function () {
    Route::get('/', 'index')->name('tips.index');
    Route::post('/store', 'store')->name('tip.store');
    Route::get('/show/{post}', 'show')->name('tip.show');
    Route::patch('/update/{post}', 'update')->name('tip.update');
    Route::delete('/destroy/{post}', 'destroy')->name('tip.delete');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('categories.index');
    Route::post('/category/store', 'store')->name('category.store');
    Route::patch('/category/update/{category}', 'update')->name('category.update');
    Route::delete('/category/destroy/{category}', 'destroy')->name('category.delete');
});

Route::get('/target_audience', function () {
    if (auth()->check() && auth()->user()->role_id === \App\Enum\Role::ADMIN) {
        return response()->json(['data' => config('targetaudience.selector')]);
    }
    return abort(403);
});
