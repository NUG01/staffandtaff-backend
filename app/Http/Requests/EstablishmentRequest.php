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
            'logo' => 'required',
            'establishment_name' => 'required',
            'company_name' => 'required',
            'country' => 'required',
            'industry' => 'required',
            'city' => 'required',
            'number_of_employees' => 'required',
            'description' => 'required',
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
