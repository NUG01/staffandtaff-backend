<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
            'currency' => 'required',
            'type_of_contract' => 'required',
            'type_of_attendance' => 'required',
            'period_type' => 'required',
            'period' => 'required',
            'availability' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'sometimes',
        ];
    }
}
