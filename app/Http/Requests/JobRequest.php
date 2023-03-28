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
            'country_code' => 'required|string|max:5',
            'position' => 'required',
            'salary' => 'required',
            'salary_type' => 'required',
            'currency' => 'required|string',
            'type_of_contract' => 'required',
            'type_of_attendance' => 'required',
            'period_type' => 'required|integer',
            'availability' => 'required',
            'start_date' => 'required',
            'end_date' => 'sometimes',
            'description' => 'required|string|min:3|max:1000',
            'city_name' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ];
    }
}
