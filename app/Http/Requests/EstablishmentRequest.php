<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstablishmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'logo' => 'sometimes',
            'establishment_name' => 'required|string',
            'company_name' => 'sometimes|string',
            'country' => 'required|integer',
            'industry' => 'required|integer',
            'city' => 'required|integer',
            'number_of_employees' => 'required|integer',
            'description' => 'required|string',
            'gallery' => 'sometimes',
            'website' => 'sometimes',
            'instagram' => 'sometimes',
            'linkedin' => 'sometimes',
            'facebook' => 'sometimes',
            'twitter' => 'sometimes',
            'pinterest' => 'sometimes',
            'youtube' => 'sometimes',
            'tik_tok' => 'sometimes',
        ];
    }
}
