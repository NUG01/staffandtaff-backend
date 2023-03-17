<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'type' => ['required', 'integer'],
            'title' => ['required', 'string'],
            'excerpt' => ['required', 'string'],
            'body' => ['required', 'string'],
            'category_id' => ['required', 'integer'],
            'secondary_title' => ['string'],
            'secondary_excerpt' => ['string'],
            'secondary_body' => ['string'],
            'image' => ['image'],
        ];
    }
}
