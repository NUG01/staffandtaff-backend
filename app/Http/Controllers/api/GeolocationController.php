<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GeolocationResource;
use App\Models\Geolocation;
use Illuminate\Http\Request;

class GeolocationController extends Controller
{
    public function index(Geolocation $city)
    {
    }
    public function show(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $cities = Geolocation::where('city_name', 'like', $request->city_name . '%')->where('country_code', '=', $request->country_code)->get();

        return GeolocationResource::collection($cities);
    }
}
