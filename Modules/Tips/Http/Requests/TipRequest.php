<?php

namespace Modules\Tips\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' =>
            [
                'required',
                'string',
                Rule::unique('tips')->ignore($this->tip)
            ],
            'description' => 'required|string',
            'category' => 'required|integer',
            'target_audience' => 'required|integer',
            'cover_image' => 'required|string',
        ];
    }
}
