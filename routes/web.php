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
    // Debugbar::info('ok');
    return Geolocation::where('city_name', 'like', '%paris%')->get();
})->name('db');

require __DIR__ . '/auth.php';
