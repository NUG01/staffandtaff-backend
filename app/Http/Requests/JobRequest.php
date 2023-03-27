<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'establishment_id' => 'required',
            'position' => 'required',
            'salary' => 'required',
            'currency' => 'required',
            'type_of_contract' => 'required',
            'type_of_attendance' => 'required',
            'period_type' => 'required',
            'period' => 'required',
            'availability' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'sometimes',
            'country_code' => 'required',
            'city_name' => 'required',
            'longitude' => 'required',
            'latitude' => 'sometimes',
        ];
    }
}
