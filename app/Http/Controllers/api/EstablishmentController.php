<?php

namespace App\Http\Controllers\api;

use App\Enum\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstablishmentRequest;
use App\Http\Resources\EstablishmentResource;
use App\Models\Establishment;
use App\Models\SocialLinks;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstablishmentController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function store(EstablishmentRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        if (Auth::user()->role_id !== null) {
            $this->authorize('recruiter', Auth()->user());
        }

        $logoPath = null;

        if ($request->file('logo')) $logoPath = $request->file('logo')->store('logos');

        $establishment = Establishment::create([
            'logo' => $logoPath,
            'name' => $request->name,
            'company_name' => $request->company_name,
            'country' => $request->country,
            'industry' => $request->industry,
            'city' => $request->city,
            'number_of_employees' => $request->number_of_employees,
            'description' => $request->description,
            'address' => $request->address,
        ]);

        EstablishmentResource::store($request, $establishment);

        Auth::user()->update([
            'type' => $establishment->id,
            'role_id' => Role::RECRUITER->value,
        ]);

        return EstablishmentResource::collection(Establishment::where('id', $establishment->id)->get());
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
