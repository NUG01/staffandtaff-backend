<?php

namespace App\Http\Controllers\api;

use App\Enum\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstablishmentRequest;
use App\Http\Resources\EstablishmentResource;
use App\Models\Establishment;
use App\Models\SocialLinks;
use App\Models\User;
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
    public function store(EstablishmentRequest $request): EstablishmentResource
    {
        if (Auth::user()->role_id !== null) {
            $this->authorize('recruiter', Auth()->user());
        }

        $logoPath = '/logos/default.png';

        if ($request->file('logo')) $logoPath = $request->file('logo')->store('logos');


        $validated = $request->validated();
        $validated['logo'] = $logoPath;

        $establishment = Establishment::create($validated);

        EstablishmentResource::storeImages($request, $establishment);

        Auth::user()->update([
            'role_id' => Role::RECRUITER->value,
            'type' => array_merge(Auth::user()->type, (array)$establishment->id),
        ]);

        return EstablishmentResource::make($establishment);
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

        $logoPath = $establishment->logo;

        if ($request->file('logo')) $logoPath = $request->file('logo')->store('logos');

        $validated = $request->validated();
        $validated['logo'] = $logoPath;

        EstablishmentResource::storeImages($request, $establishment);

        $establishment->update($validated);

        return EstablishmentResource::make($establishment);
    }
}
