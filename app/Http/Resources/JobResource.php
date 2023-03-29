<?php

namespace App\Http\Resources;

use App\Models\Establishment;
use App\Models\Geolocation;
use App\Models\Like;
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
            'city_name' => $this->city_name,
            'currency' => $this->currency,
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
            'likes' => $this->likes,
            'establishment' => $this->establishment,
            // 'establishment' => Establishment::where('id', $this->establishment_id)->get(['name', 'id']),
        ];
    }
}
