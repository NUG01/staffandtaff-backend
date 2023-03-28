<?php

namespace Modules\Tips\Http\Requests;

use App\Enum\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TipRequest extends FormRequest
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
            'title' => [
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
