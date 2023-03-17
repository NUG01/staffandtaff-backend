<?php

use App\Http\Controllers\api\{BlogController, CategoryController, EstablishmentController, IndustryController, JobController, SubscriptionController, FaqController};
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Auth\AboutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Route, Storage,};

// Auth route
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return UserResource::make($request->user());
});

Route::get('/test', function () {
    return UserResource::collection(User::where('id', Auth()->user()->id)->get());
});

// Industry and position Routes
Route::controller(IndustryController::class)->group(function () {
    Route::get('/industries', 'index')->name('industry.index');
    Route::get('/positions', 'positionsList')->name('position.index');
    Route::post('/industry/store', 'store')->name('industry.store');
    Route::post('/position/store/{industry}', 'storePosition')->name('position.store');
    Route::get('/industry/{industry}', 'show')->name('industry.show');
    Route::patch('/industry/update/{industry}', 'update')->name('industry.update');
    Route::patch('/position/update/{position}', 'updatePosition')->name('position.update');
    Route::delete('/industry/delete/{industry}', 'destroy')->name('industry.delete');
    Route::delete('/position/delete/{position}', 'destroyPosition')->name('position.delete');
});

//Ad Routes
Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', 'index')->name('ad.index');
    Route::post('/job/store', 'store')->name('ad.store');
    Route::get('/job/{job}', 'show')->name('ad.show');
    Route::patch('/job/update/{job}', 'update')->name('ad.update');
    Route::delete('/job/delete/{job}', 'delete')->name('ad.delete');
});

//Establishment Routes
Route::controller(EstablishmentController::class)->group(function () {
    Route::post('/establishment/store', 'store')->name('establishment.store');
    Route::get('/establishment/{establishment}', 'show')->name('establishment.show');
    Route::patch('/establishment/update/{establishment}', 'update')->name('establishment.update');
});

//Faq Routes
Route::controller(FaqController::class)->group(function () {
    Route::post('/faq/create', 'store')->name('faq.store');
    Route::get('/faq', 'index')->name('faq.index');
    Route::get('/faq/{category}', 'getSpecificCategory')->name('faq.category');
    Route::delete('/faq/update/{id}', 'destroy')->name('faq.destroy');
    Route::put('/faq/delete/{faq:id}', 'update')->name('faq.update');
});

//Stripe Routes
Route::middleware(['auth:sanctum'])->controller(SubscriptionController::class)->group(function () {
    Route::get('/user-intent', 'userIntent')->name('stripe.payment');
    Route::post('/payment', 'subscribe')->name('stripe.subscribe');
});

//Blog Category Routes
Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'index')->name('category.index');
    Route::post('/category/create', 'create')->name('category.create');
    Route::delete('/category/delete/{category:id}', 'destroy')->name('category.destroy');
});

//Blog Routes
Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'index')->name('blog.index');
    Route::post('/blog', 'create')->name('blog.create');
    Route::get('/blog/{blog:id}', 'getSpecificBlog')->name('blog.specific');
    Route::delete('/blog/{category:id}', 'destroy')->name('blog.destroy');
});

Route::post('user-mail', [AboutController::class, 'store'])->name('user.mail');
