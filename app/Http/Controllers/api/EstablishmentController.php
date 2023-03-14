<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstablishmentRequest;
use App\Http\Resources\EstablishmentResource;
use App\Models\Establishment;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class EstablishmentController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function store(EstablishmentRequest $request): JsonResponse
    {
        $this->authorize('recruiter', Auth()->user());

        EstablishmentResource::store($request);

        return response()->json(['status' => 'establishment created!']);
    }

    public function show(Establishment $establishment): EstablishmentResource
    {
        return EstablishmentResource::make($establishment);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Establishment $establishment, EstablishmentRequest $request): EstablishmentResource
    {
        $this->authorize('recruiter', Auth()->user());

        $updated_establishment = EstablishmentResource::update($establishment, $request);

        return EstablishmentResource::make($updated_establishment);
    }

}
