<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UpdateEstablishmentRequest;
use App\Http\Resources\admin\EstablishmentResource as AdminEstablishmentResource;
use App\Models\Establishment;
use App\Models\Geolocation;
use App\Models\Industry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class EstablishmentController extends Controller
{
    public function index()
    {

        return AdminEstablishmentResource::collection(Establishment::all());
    }

    public function establishmentDetails(Establishment $est)
    {

        $estData = [
            'id' => $est->id,
            'name' => $est->name,
            'company_name' => $est->company_name,
            'country' => $est->country,
            'city' => Geolocation::where('id', $est->id)->value('city_name'),
            'address' => $est->address,
            'number_of_employees' => $est->number_of_employees,
            'description' => $est->description,
            'industry' => Industry::where('id', $est->industry)->first(),
        ];

        return response()->json($estData);
    }

    public function destroy(Establishment $est)
    {
        $est->delete();
        return AdminEstablishmentResource::collection(Establishment::all());
    }

    public function update(UpdateEstablishmentRequest $request)
    {
        return response()->json($request);
    }

    private static function getColumnNames()
    {
        $est = new Establishment();
        $tableName = $est->getTable();
        return Schema::getColumnListing($tableName);
    }
}