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
            'logo' => $this->logo,
            'name' => $this->name,
            'company_name' => $this->company_name,
            'industry' => IndustryResource::collection(Industry::where('id', $this->industry)->get()),
            'country' => $this->country,
            'city' => GeolocationResource::collection(Geolocation::where('id', $this->city)->get()),
            'address' => $this->address,
            'number_of_employees' => $this->number_of_employees,
            'description' => $this->description,
            'social_media_links' => SocialLinksResource::collection(SocialLinks::where('establishment_id', $this->id)->get()),
            'gallery' => GalleryResource::collection(Gallery::where('establishment_id', $this->id)->get()),
        ];
    }

    public static function storeImages($request, $establishment)
    {
        if (request()->has('file')) {
            for ($i = 0; $i < count(request()->file('file')); $i++) {
                $currentImage = request()->file('file')[$i]->store('gallery');

                $establishment->gallery()->create([
                    'path' => $currentImage,
                ]);
            }

            self::storeOrUpdateSocialLinks($request, $establishment);
        }
    }

    public static function storeOrUpdateSocialLinks($request, $establishment)
    {
        $links = [
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

        $linksArePresent = SocialLinks::where('establishment_id', $establishment->id)->get();
        if ($linksArePresent->isNotEmpty()) {
            SocialLinks::where('establishment_id', $establishment->id)->update($links);
        }

        if ($linksArePresent->isEmpty()) {
            SocialLinks::create($links);
        }
        // match ($user_type_id) {
        //     // [] => $establishment = SocialLinks::create($items),
        // };
        return $establishment;
    }
}
