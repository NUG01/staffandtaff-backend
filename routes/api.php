<?php

use App\Http\Controllers\api\{AdController, IndustryController, EstablishmentController, SubscriptionController};
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{App, Auth, Route,};

// Auth route
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return response()->json(['user' => $request->user()]);
});

// Industry and position Routes
Route::controller(IndustryController::class)->group(function () {
    Route::get('/industries', 'index')->name('industry.index');
    Route::get('/positions', 'positionsList')->name('industry.index');
    Route::post('/industry/store', 'store')->name('industry.store');
    Route::post('/position/store/{industry}', 'storePosition')->name('position.store');
    Route::get('/industry/{industry}', 'show')->name('industry.show');
    Route::patch('/industry/update/{industry}', 'update')->name('industry.update');
    Route::patch('/position/update/{position}', 'updatePosition')->name('position.store');
    Route::delete('/industry/delete/{industry}', 'destroy')->name('industry.delete');
    Route::delete('/position/delete/{position}', 'destroyPosition')->name('position.delete');
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


Route::middleware(['auth:sanctum'])->controller(SubscriptionController::class)->group(function () {
    Route::get('/user-intent', 'userIntent')->name('stripe.payment');
    Route::post('/payment', 'subscribe')->name('stripe.subscribe');
});
