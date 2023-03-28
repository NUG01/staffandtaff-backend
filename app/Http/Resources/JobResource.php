<?php

namespace App\Http\Resources;

use App\Models\Geolocation;
use App\Models\Position;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'position' => Position::where('id', $this->position)->value('name'),
            'salary' => $this->salary,
            'salary_type' => $this->salary_type,
            'city_name' => Geolocation::where('id', $this->city_name)->value('city_name'),
            'currency' => config('job-assets.currency')[$this->currency],
            'type_of_contract' => config('job-assets.type-of-contract')[$this->type_of_contract],
            'type_of_attendance' => config('job-assets.type-of-attendance')[$this->type_of_attendance],
            'period_type' => config('job-assets.period-type')[$this->period_type],
            'availability' => config('job-assets.availability')[$this->availability],
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'country_code' => $this->country_code,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        ];
    }
}
