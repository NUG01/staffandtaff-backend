<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "id" => ['required'],
            "establishment" => ['required'],
            "salary" => ['required'],
            "position" => ['required'],
            "currency" => ['required'],
            "contract" => ['required'],
            "attendance" => ['required'],
            "period" => ['required'],
            "availability" => ['required'],
            "description" => ['required'],
            "city" => ['required'],
            "country_code" => ['required'],
            "longitude" => ['required'],
            "latitude" => ['required'],
        ];
    }
}
