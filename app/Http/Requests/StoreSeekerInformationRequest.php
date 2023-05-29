<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSeekerInformationRequest extends FormRequest
{
 
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
    
        return [
            'information.fullname' => ['required', 'string'],
            'information.birthdate' => ['required', 'date'],
            'information.gender' => ['required'],
            'information.desired_position' => ['required'],
            'information.current_position' => ['sometimes'],
            'information.desired_country' => ['sometimes'],
            'information.desired_city' => ['sometimes'],
            'information.more_info' => ['max:1000'],
            'information.social_links' => ['array','sometimes'],
            'information.cover_letter' => ['max:1000'],

             'education'=>['array',  
             'education.*.studyField' => ['required', 'string', 'in:yes,no'],
             'education.*.establishment' => ['required', 'string', 'in:yes,no'],
             'education.*.date.day' => ['sometimes','in:yes,no'],
             'education.*.date.year' => ['required','in:yes,no'],
             'education.*.date.year' => ['required','in:yes,no'],
             'education.*.certification' => ['sometimes', 'in:yes,no'],    
            ],

            'experience'=>['array',  
            'experience.*.position' => ['required', 'string', 'in:yes,no'],
            'experience.*.establishment' => ['required', 'string', 'in:yes,no'],
            'experience.*.date.day' => ['sometimes','in:yes,no'],
            'experience.*.date.year' => ['required','in:yes,no'],
            'experience.*.date.year' => ['required','in:yes,no'],
            'experience.*.finishDate.day' => ['sometimes','in:yes,no'],
            'experience.*.finishDate.year' => ['required','in:yes,no'],
            'experience.*.finishDate.year' => ['required','in:yes,no'],
            'experience.*.info' => ['sometimes', 'in:yes,no'],
        ],
            'letter' => ['sometimes', 'max:1000'],
        ];
    }
}
