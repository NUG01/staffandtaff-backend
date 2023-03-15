<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndustryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'children_id' => 'sometimes',
            'name' => ['required',
                Rule::unique('industries')->ignore($this->industry),
                Rule::unique('positions')->ignore($this->position),
            ],
        ];
    }
}
