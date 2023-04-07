<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstablishmentRequest extends FormRequest
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
            'id' => ['required'],
            'name' => ['required', 'string'],
            'company_name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'country' => ['required', 'string'],
            'industry_id' => ['required', 'integer'],
            'number_of_employees' => ['required', 'integer'],
            'description' => ['required', 'string', 'min:2', 'max:1000'],
        ];
    }
}
