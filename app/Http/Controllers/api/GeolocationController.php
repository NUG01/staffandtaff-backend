<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Geolocation;
use Illuminate\Http\Request;

class GeolocationController extends Controller
{
    public function index(Geolocation $city)
    {
    }
    public function show(Request $request)
    {

        $cities = Geolocation::where('city_name', 'like', '%' . $request->city_name . '%')->where('country_code', '=', $request->country_code)->get();

        return response()->json(['cities' => $cities]);
    }
}
