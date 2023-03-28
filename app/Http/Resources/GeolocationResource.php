<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeolocationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'country_code' => $this->country_code,
            'city_name' => $this->city_name,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        ];
    }
}
