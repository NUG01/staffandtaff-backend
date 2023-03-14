<?php

use Illuminate\Support\Facades\Route;
use Modules\Tips\Http\Controllers\api\{CategoryController, TipController};

Route::controller(TipController::class)->group(function () {
    Route::get('/', 'index')->name('posts.index');
    Route::post('/store', 'store')->name('post.store');
    Route::get('/show/{post}', 'show')->name('post.show');
    Route::patch('/update/{post}', 'update')->name('post.update');
    Route::delete('/destroy/{post}', 'destroy')->name('post.delete');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('categories.index');
    Route::post('/category/store', 'store')->name('category.store');
    Route::patch('/category/update/{category}', 'update')->name('category.update');
    Route::delete('/category/destroy/{category}', 'destroy')->name('category.delete');
});

Route::get('/target_audience', function () {
    return response()->json(['data' => config('targetaudience.selector')]);
});
