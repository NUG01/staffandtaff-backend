<?php

use App\Models\Geolocation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;


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

Route::get('/db', function () {

    $myCity = Geolocation::where('id', '=', 1)->first();
    $coords = [$myCity->longitude, $myCity->latitude];
    // $coords = [2.35, 48.85];
    $cities = Geolocation::query()->selectDistanceTo($coords)->withinDistanceTo($coords, 10000)->get();
    return $cities;
})->name('db');

require __DIR__ . '/auth.php';
