<?php

namespace Modules\Tips\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|integer',
            'target_audience' => 'required|integer',
            'cover_image' => 'required|string',
        ];
    }
}
