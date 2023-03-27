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
            'position' => 'required',
            'salary' => 'required',
            'currency' => 'required|string',
            'type_of_contract' => 'required',
            'type_of_attendance' => 'required',
            'period_type' => 'required|integer',
            'period' => 'required|string',
            'availability' => 'required',
            'start_date' => 'required',
            'end_date' => 'sometimes',
            'description' => 'required|string|min:3|max:1000',
            'country_code' => 'required',
            'city_name' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ];
    }
}
