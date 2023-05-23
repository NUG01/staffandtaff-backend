<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSeekerInformationRequest extends FormRequest
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
            'fullname' => ['required', 'string'],
            'birthdate' => ['required', 'date'],
            'gender' => ['required'],
            'desired_position' => ['required', 'exists:positions,name'],
            'current_position' => ['sometimes'],
            'desired_country' => ['sometimes'],
            'desired_city' => ['sometimes'],
            'more_info' => ['digits_between:0,1000'],
            'website' => ['sometimes'],
            'instagram' => ['sometimes'],
            'linkedin' => ['sometimes'],
            'facebook' => ['sometimes'],
            'twitter' => ['sometimes'],
            'pinterest' => ['sometimes'],
            'youtube' => ['sometimes'],
            'tik_tok' => ['sometimes'],
            'experience' => ['array', 'required'],
            'education' => ['array', 'required'],
            'cover_letter' => ['max:1000']
        ];
    }
}
