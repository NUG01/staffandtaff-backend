<?php

use App\Http\Controllers\api\{EstablishmentController, IndustryController, JobController, SubscriptionController, FaqController};
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
    Route::patch('/faq/delete/{id}', 'update')->name('faq.update');
});

//Stripe Routes
Route::middleware(['auth:sanctum'])->controller(SubscriptionController::class)->group(function () {
    Route::get('/user-intent', 'userIntent')->name('stripe.payment');
    Route::post('/payment', 'subscribe')->name('stripe.subscribe');
});

Route::post('user-mail', [AboutController::class, 'store'])->name('user.mail');

// Route::get('db', function () {
//     // $frenchCities = json_decode($frenchCities, true);
//     // $switzCities = json_decode($switzCities, true);
//     $frenchCities = Storage::disk('local')->get('france.json');
//     $switzCities = Storage::disk('local')->get('switzerland.json');

//     $cities = json_encode(
//         array_merge(
//             json_decode($frenchCities, true),
//             json_decode($switzCities, true)
//         )
//     );

//     $cities = json_decode($cities, true);
//     foreach ($cities as $key => $value) {
//         // $city = $value['city'];
//         // // $country = $value['country'];
//         // $iso2 = $value['iso2'];
//         // $lat = $value['lat'];
//         // $lng = $value['lng'];

//         DB::table('geolocations')->insert([
//             'country_code' => $value['iso2'],
//             'city_name' => $value['city'],
//             'latitude' => $value['lat'],
//             'longitude' => $value['lng'],
//         ]);

//         // echo "Id: {$city}, Name: {$country}, code: {$iso2}, lat: {$lat}, lng: {$lng}";
//         // echo $value['department'];
//     }
//     return 'saved';

//     // return json_decode($cities[0]['city']);
//     // return $cities;
// });
