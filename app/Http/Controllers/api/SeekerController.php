<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSeekerInformationRequest;
use App\Models\Education;
use App\Models\Experience;
use App\Models\SocialLinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeekerController extends Controller
{
    public function store(StoreSeekerInformationRequest $request)
    {
        return response()->json($request);


        $data = [
            'fullname' => $request->fullname,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'desired_position' => $request->desired_position,
            'current_position' => $request->current_position,
            'desired_country' => $request->desired_country,
            'desired_city' => $request->desired_city,
            'more_info' => $request->more_info,
            'cover_letter' => $request->cover_letter,
        ];

        $links = [
            'website' => $request->website,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'pinterest' => $request->pinterest,
            'youtube' => $request->youtube,
            'tik_tok' => $request->tik_tok,
            'user_type_id' => Auth::user()->id,
        ];

        SocialLinks::create($links);


        for ($i = 0; $i < count($request->experience); $i++) {
            Experience::create([
                'user_id' => Auth::user()->id,
                'position' => $request->experience_position,
                'start_date' => $request->experience_start_date,
                'end_date' => $request->experience_end_date,
                'more_info' => $request->experience_more_info,
                'establishment' => $request->establishment,
                'more_info' => $request->experience_more_info,

            ]);
        }
        for ($i = 0; $i < count($request->education); $i++) {
            Education::create([
                'user_id' => Auth::user()->id,
                'establishment' => $request->education_establishment,
                'certification_type' => $request->education_certification_type,
                'field_of_study' => $request->education_field_of_study,
                'graduation_day' => $request->education_graduation_day,
                'graduation_month' => $request->education_graduation_month,
                'graduation_year' => $request->education_graduation_year,
            ]);
        }
    }


    public function getPositions($position){
        $positions=DB::table('positions')->where('name', 'like', '%' .  $position . '%')->orWhere('slug', 'like', '%' .  $position . '%')->get();

        return response()->json($positions);
    }
}
