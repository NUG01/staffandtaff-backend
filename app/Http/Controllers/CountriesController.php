<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countries;
use App\Models\Geolocation;

class CountriesController extends Controller
{
//    don't touch this file
    public function pp(){
        $gl = Geolocation::select('id')->OrderBy('id','DESC')->first();
        if ($gl >= '82363'){
            $sum = intval($gl->id) - 82363;
        }else{
            $sum = $gl;
        }
        $cc = Countries::where('id','>',$sum)->select('id','name','latitude','longitude','country_code')->get();
       foreach ($cc as $c){
               Geolocation::create([
            'city_name' => $c->name,
            'latitude' => $c->latitude,
            'longitude' => $c->longitude,
            'country_code' => $c->country_code,
        ]);
       }
    }
}
