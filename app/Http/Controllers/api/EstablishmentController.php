<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstablishmentRequest;
use App\Http\Resources\EstablishmentResource;
use App\Models\Establishment;

class EstablishmentController extends Controller
{
    public function store(EstablishmentRequest $request): \Illuminate\Http\JsonResponse
    {
        $establishment = EstablishmentResource::store($request);

        return response()->json(['status' => 'establishment created!']);
    }

    public function show(Establishment $establishment): EstablishmentResource
    {
        return EstablishmentResource::make($establishment);
    }

    public function update(Establishment $establishment, EstablishmentRequest $request): EstablishmentResource
    {
        $updated_establishment = EstablishmentResource::update($establishment, $request);

        return EstablishmentResource::make($updated_establishment);
    }

}
