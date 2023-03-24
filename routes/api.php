<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\api\{
    EstablishmentController,
    IndustryController,
    JobController,
    SubscriptionController,
    FaqController,
    GeolocationController,
    TermsAndConditionController
};
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Auth\AboutController;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Request as FacadesRequest, Route, Storage,};
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\Establishment;
use App\Models\Geolocation;
use App\Http\Controllers\api\CommentController;

// Auth route
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return UserResource::make($request->user());
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

//Job Routes
Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', 'index')->name('job.index');
    Route::post('/job/store', 'store')->name('job.store');
    Route::get('/job/{job}', 'show')->name('job.show');
    Route::patch('/job/update/{job}', 'update')->name('job.update');
    Route::delete('/job/delete/{job}', 'delete')->name('job.delete');
});

//Establishment Routes
Route::controller(EstablishmentController::class)->group(function () {
    Route::post('/establishment/store', 'store')->name('establishment.store');
    Route::get('/establishment/{establishment}', 'show')->name('establishment.show');
    Route::patch('/establishment/update/{establishment}', 'update')->name('establishment.update');
});

//Geolocation Routes
Route::controller(GeolocationController::class)->group(function () {
    Route::get('/city/{city:id}', 'index')->name('geolocation.index');
    Route::post('/cities', 'show')->name('geolocation.show');
});

//Faq Routes
Route::controller(FaqController::class)->group(function () {
    Route::post('/faq/create', 'store')->name('faq.store');
    Route::get('/faq', 'index')->name('faq.index');
    Route::get('/faq/{category}', 'getSpecificCategory')->name('faq.category');
    Route::delete('/faq/update/{id}', 'destroy')->name('faq.destroy');
    Route::put('/faq/delete/{faq:id}', 'update')->name('faq.update');
});


//Terms & conditions, Privacy Policy routes
Route::controller(TermsAndConditionController::class)->group(function () {
    Route::get('/terms_and_conditions', 'index')->name('termsAndConditions.index');
    Route::post('/terms_and_conditions', 'store')->name('termsAndConditions.store');
    Route::get('/terms_and_conditions/show/{termsAndCondition}', 'show')->name('termsAndConditions.show');
    Route::patch('/terms_and_conditions/update/{termsAndCondition}', 'update')->name('termsAndConditions.update');
});

//Stripe Routes
Route::middleware(['auth:sanctum'])->controller(SubscriptionController::class)->group(function () {
    Route::get('/user-intent', 'userIntent')->name('stripe.payment');
    Route::post('/payment', 'subscribe')->name('stripe.subscribe');
});

Route::post('user-mail', [AboutController::class, 'store'])->name('user.mail');

Route::post('comment',[CommentController::class,'store'])->name('comment');
