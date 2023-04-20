<?php

use App\Http\Controllers\api\{
    EstablishmentController,
    FaqController,
    GeolocationController,
    IndustryController,
    JobController,
    StripeController,
    SubscriptionController,
    TermsAndConditionController,
    RatingController,
};
use App\Http\Controllers\admin\{
    EstablishmentController as AdminEstablishmentController,
    JobController as AdminJobController,
    UsersController as AdminUserController,
    StatController as AdminStatController,
    AuthController as AdminAuthController,
    PaymentController as AdminPaymentController,
    FaqController as AdminFaqController,
};
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\Auth\AboutController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Route,};

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
    Route::post('/job/store/{establishment}', 'store')->name('job.store');
    Route::get('/job/{job}', 'show')->name('job.show');
    Route::patch('/job/update/{job}', 'update')->name('job.update');
    Route::delete('/job/delete/{job}', 'delete')->name('job.delete');
    Route::post('/job-like', 'like')->name('job.like');
});

Route::get('/job_assets', fn () => response()->json(config('job-assets')));

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
// Route::middleware(['auth:sanctum'])->controller(SubscriptionController::class)->group(function () {
Route::middleware(['auth'])->controller(SubscriptionController::class)->group(function () {
    Route::get('/user-intent', 'userIntent')->name('stripe.payment');
    Route::post('/payment', 'subscribe')->name('stripe.subscribe');
});

Route::post('user-mail', [AboutController::class, 'store'])->name('user.mail');

Route::post('comment', [CommentController::class, 'store'])->name('comment');

Route::post('cancel-subscription', [StripeController::class, 'handleCustomerDeleted'])->name('stripe.cancel');

// rating
Route::post('recruiter/rating/{rating?}', [RatingController::class, 'recruiterRating'])->name('recruiter.rating');
Route::post('establishment/rating/{rating?}', [RatingController::class, 'establishmentRating'])->name('establishment.rating');



//Admin
Route::controller(AdminEstablishmentController::class)->group(function () {
    Route::get('/admin/establishments', 'index')->name('admin.establishment.index');
    Route::get('/admin/establishment/{est}', 'establishmentDetails')->name('admin.establishment.details');
    Route::delete('/admin/establishments/delete/{est}', 'destroy')->name('admin.establishment.delete');
    Route::post('/admin/establishments/update', 'update')->name('admin.establishment.update');
    Route::post('/admin/establishments-gallery/update/{id}', 'updateImage')->name('admin.establishment.image.update');
});


Route::controller(AdminUserController::class)->group(function () {
    Route::get('/admin/users', 'index')->name('admin.user.index');
    Route::get('/admin/user', 'show')->middleware('auth:sanctum')->name('admin.user.show');
    Route::get('/admin/user/{user}', 'userDetails')->name('admin.user.details');
    Route::post('/admin/user/update', 'update')->name('admin.user.update');
    Route::post('/admin/update', 'updateAdmin')->name('admin.update');
    Route::delete('/admin/user/delete/{user}', 'destroy')->name('admin.user.delete');
});


Route::controller(AdminJobController::class)->group(function () {
    Route::get('/admin/jobs', 'index')->name('admin.job.index');
    Route::post('/admin/jobs/update', 'update')->name('admin.job.update');
    Route::get('/admin/job/{job}', 'jobDetails')->name('admin.job.details');
    Route::delete('/admin/jobs/delete/{job}', 'destroy')->name('admin.job.delete');
});

Route::controller(AdminStatController::class)->group(function () {
    Route::get('/admin/stats', 'index')->name('admin.stat.index');
});
Route::controller(AdminFaqController::class)->group(function () {
    Route::get('/admin/faqs', 'index')->name('admin.faq.index');
    Route::post('admin/faq/create', 'store')->name('faq.admin.store');
    Route::delete('/admin/faq/delete/{id}', 'destroy')->name('admin.faq.delete');
    Route::get('/admin/faq/{faq:id}', 'show')->name('admin.faq.index');
});



Route::controller(AdminAuthController::class)->group(function () {
    Route::post('/admin-login', 'adminLogin')->name('admin.login');
    Route::get('/admin-user', 'admin')->name('admin.user');
});

Route::controller(AdminPaymentController::class)->group(function () {
    Route::get('/subscriptions', 'index')->name('subscriptions.index');
    Route::get('/admin/subscription/{id}', 'show')->name('subscriptions.show');
    Route::delete('/admin/payment/delete/{id}', 'destroy')->name('subscriptions.delete');
    Route::post('/admin/cancel-subscription', 'cancelSubscription')->name('admin.stripe.cancel');
});
