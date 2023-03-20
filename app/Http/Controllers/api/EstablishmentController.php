<?php

namespace App\Http\Controllers\api;

use App\Enum\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstablishmentRequest;
use App\Http\Resources\EstablishmentResource;
use App\Models\Establishment;
use App\Models\EstablishmentLinks;
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
    // public function store(EstablishmentRequest $request)
    public function store(EstablishmentRequest $request)
    {
        $this->authorize('recruiter', Auth()->user());

        $logoPath = $request->file('logo')->store('logos');

        $establishment = Establishment::create([
            'logo' => $logoPath,
            'name' => $request->establishment_name,
            'company_name' => $request->company_name,
            'country' => $request->country,
            'industry' => $request->industry,
            'city' => $request->city,
            'number_of_employees' => $request->number_of_employees,
            'description' => $request->description,
        ]);

        if (request()->has('file')) {
            return request()->company_name;
            for ($i = 0; $i < count(request()->file('file')); $i++) {
                $currentImage = request()->file('file')[$i]->store('gallery');

                DB::table('galleries')->insert([
                    'name' => $currentImage,
                    'establishment_id' => 1
                ]);
            }
        }

        EstablishmentLinks::create([
            'website' => $request->website,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'pinterest' => $request->pinterest,
            'youtube' => $request->youtube,
            'tik_tok' => $request->tik_tok,
            'establishment_id' => $establishment->id,
        ]);

        return Auth::user()->update([
            'type' => $establishment->id,
            'role_id' => Role::RECRUITER->value,
        ]);

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
