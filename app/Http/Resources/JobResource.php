<?php

namespace App\Http\Resources;

use App\Models\Industry;
use App\Models\Gallery;
use App\Models\Position;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class JobResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'position' => PositionResource::collection(Position::where('id', $this->position)),
            'salary' => $this->salary,
            'salary_type' => $this->salary_type,
            'city' => $this->city,
            'currency' => $this->currency,
            'type_of_contract' => $this->type_of_contract,
            'type_of_attendance' => $this->type_of_attendance,
            'period_type' => $this->period_type,
            'period' => $this->period,
            'availability' => $this->availability,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'country_code' => $this->country_code,
            'city_name' => $this->city_name,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        ];
    }
}
