<?php

use App\Models\Geolocation;
use App\Models\Job;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/swagger', fn () => App::isProduction() ? response(status: 403) : view('swagger'))->name('swagger');

Route::get('ok', function (Request $request) {

    $cities = Geolocation::where('city_name', 'like',  'paris 01%')->where('country_code', '=', 'FR')->get();

    return view('ok', ['cities' => $cities]);


    // $cities = Geolocation::where('city_name', 'like',  '%paris 01' . '%')->where('country_code', '=', 'FR')->get();

    // return view('ok', ['cities' => $cities]);
});


require __DIR__ . '/auth.php';
