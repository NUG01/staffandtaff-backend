<?php

namespace App\Http\Resources;

use App\Enum\Role;
use App\Models\Establishment;
use App\Models\Geolocation;
use App\Models\Industry;
use App\Models\SocialLinks;
use App\Models\Gallery;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstablishmentResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'establishment_name' => $this->establishment_name,
            'company_name' => $this->company_name,
            'industry' => IndustryResource::collection(Industry::where('id', $this->industry)->get()),
            'country' => $this->country,
            'city' => GeolocationResource::collection(Geolocation::where('id', $this->city)->get()),
            'address' => $this->address,
            'number_of_employees' => $this->number_of_employees,
            'description' => $this->description,
            'social_media_links' => SocialLinksResource::collection(SocialLinks::where('user_type_id', $this->id)->get()),
            'gallery' => GalleryResource::collection(Gallery::where('establishment_id', $this->id)->get()),
        ];
    }

    public static function store($request, $establishment)
    {
        if (request()->has('file')) {
            for ($i = 0; $i < count(request()->file('file')); $i++) {
                $currentImage = request()->file('file')[$i]->store('gallery');

                $establishment->gallery()->create([
                    'path' => $currentImage,
                ]);
            }

            $user_type_id = SocialLinks::where('user_type_id', $establishment->id);

            if ($user_type_id->get()->count() > 0) {
                return $user_type_id->update([
                    'website' => $request->website,
                    'instagram' => $request->instagram,
                    'linkedin' => $request->linkedin,
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'pinterest' => $request->pinterest,
                    'youtube' => $request->youtube,
                    'tik_tok' => $request->tik_tok,
                ]);
            }

            return SocialLinks::create([
                'website' => $request->website,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'pinterest' => $request->pinterest,
                'youtube' => $request->youtube,
                'tik_tok' => $request->tik_tok,
                'user_type_id' => $establishment->id,
            ]);
        }
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
            'user_type_id' => $establishment->id,
        ];

        $social_links = SocialLinks::where('establishment_id', $establishment->id);

        match ($social_links->get()) {
            [] => SocialLinks::create($items),
            default => $social_links->update($items),
        };

        return $establishment;
    }
}
