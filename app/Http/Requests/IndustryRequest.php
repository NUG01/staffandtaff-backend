<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'children_id' => 'sometimes',
            'name' => 'required|unique:categories|unique:subcategories',
        ];
    }
}
