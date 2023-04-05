<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            // 'position' => Position::where('id', $this->position)->value('name'),
            'salary' => $this->salary,
            // 'salary_type' => $this->salary_type,
            'city_name' => $this->city_name,
            'currency' => $this->currency,
            'type_of_contract' => config('job-assets.type-of-contract')[$this->type_of_contract],
            'type_of_attendance' => config('job-assets.type-of-attendance')[$this->type_of_attendance],
            'period_type' => config('job-assets.period-type')[$this->period_type],
            'availability' => config('job-assets.availability')[$this->availability],
        ];
    }
}
