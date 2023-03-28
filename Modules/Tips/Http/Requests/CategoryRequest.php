<?php

namespace Modules\Tips\Http\Requests;

use App\Enum\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (Auth::user()->role_id === Role::ADMIN->value) {
            return true;
        }
        return false;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('tip_categories')->ignore($this->category)
            ]
        ];
    }
}

