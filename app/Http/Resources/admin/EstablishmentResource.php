<?php

namespace App\Http\Resources\admin;

use App\Enum\Role;
use App\Http\Resources\GalleryResource;
use App\Http\Resources\GeolocationResource;
use App\Http\Resources\IndustryResource;
use App\Http\Resources\JobResource;
use App\Http\Resources\SocialLinksResource;
use App\Models\Establishment;
use App\Models\Geolocation;
use App\Models\Industry;
use App\Models\Job;
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
            'name' => $this->name,
            'company_name' => $this->company_name,
            'country' => $this->country,
            'address' => $this->address,
            'number_of_employees' => $this->number_of_employees,
        ];
    }
}
