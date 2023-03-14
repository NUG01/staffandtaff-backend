<?php

namespace App\Http\Resources;

use App\Enum\UserRoleEnum;
use App\Models\Establishment;
use App\Models\EstablishmentLinks;
use App\Models\Gallery;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstablishmentResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'establishment_id' => $this->id,
            'establishment_name' => $this->establishment_name,
            'company_name' => $this->company_name,
            'company' => $this->company,
            'country' => $this->country,
            'city' => $this->city,
            'number_of_employees' => $this->number_of_employees,
            'description' => $this->description,
            'start_date' => $this->start_date->format('d/m/Y'),
            'end_date' => $this->end_date->format('d/m/Y'),
            'social_media_links' => EstablishmentLinksResource::collection(EstablishmentLinks::where('establishment_id', $this->id)->get()),
            'gallery' => Gallery::where('establishment_id', $this->id)->get('name'),
        ];
    }

    public static function store($request)
    {
        $establishment_id = Establishment::create([
            'logo' => $request->logo,
            'establishment_name' => $request->establishment_name,
            'company_name' => $request->company_name,
            'country' => $request->country,
            'industry' => $request->industry,
            'city' => $request->city,
            'number_of_employees' => $request->number_of_employees,
            'description' => $request->description,
        ]);

        EstablishmentLinks::create([
            'website' => $request->website,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'pinterest' => $request->pinterest,
            'youtube' => $request->youtube,
            'tik_tok' => $request->tik_tok,
            'establishment_id' => $establishment_id->id,
        ]);

        return Auth::user()->update([
            'type' => $establishment_id,
            'role_id' => UserRoleEnum::RECRUITER,
        ]);
    }

    public static function update($establishment, $request)
    {
        $establishment->update([
            'logo' => $request->logo,
            'establishment_name' => $request->establishment_name,
            'company_name' => $request->company_name,
            'country' => $request->country,
            'industry' => $request->industry,
            'city' => $request->city,
            'number_of_employees' => $request->number_of_employees,
            'description' => $request->description,
        ]);

        $items = [
            'website' => $request->website,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'pinterest' => $request->pinterest,
            'youtube' => $request->youtube,
            'tik_tok' => $request->tik_tok,
            'establishment_id' => $establishment->id,
        ];

        $establishment_links = EstablishmentLinks::where('establishment_id', $establishment->id);

        match ($establishment_links->get()) {
            [] => EstablishmentLinks::create($items),
            default => $establishment_links->update($items),
        };

        return $establishment;
    }
}
