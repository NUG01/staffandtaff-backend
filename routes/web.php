<?php

use App\Http\Resources\JobResource;
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

    return JobResource::collection(Job::paginate(12));


    $coords = [8.48335, 47.1313];
    $jobs = Job::query()
        //location filter
        ->when(
            true,
            function ($query) use ($coords) {
                $query->select('*')
                    ->selectDistanceTo($coords)
                    ->withinDistanceTo($coords, ((100) * 1000));
            }
            //contract filter
        )->when(true, function ($query) {
            $query->where('type_of_contract', 1);
            //category filter
            //start date filter
            //min-max range filter
        })->when(true, function ($query) {
            $query->whereBetween('salary', [100, 300]);
            //min range filter
            //max range filter
            //period filter
        })->when(true, function ($query) {
            $query->where('period', '=', 'year');
            //text filter
        })->when(true, function ($query) {
            // $query->join('establishments', 'jobs.establishment_id', '=', 'establishments.id', function())
            $query->join('establishments', 'jobs.establishment_id', '=', 'establishments.id');
        })
        ->when(true, function ($query) {
            collect(explode(' ', 'establishment name'))->filter()->each(function ($term) use ($query) {
                $term =  '%' . $term . '%';

                $query->where('name', 'like', $term);
            });
        })
        ->get()
        ->makeHidden(['number_of_employees', 'industry', 'address', 'city', 'country', 'logo']);

    return view('ok', ['cities' => $jobs]);
});


require __DIR__ . '/auth.php';
