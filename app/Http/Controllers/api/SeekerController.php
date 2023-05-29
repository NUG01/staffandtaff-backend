<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSeekerInformationRequest;
use App\Models\Education;
use App\Models\Experience;
use App\Models\SeekerInformation;
use App\Models\SocialLinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeekerController extends Controller
{
    public function store(StoreSeekerInformationRequest $request)
    {
        
        $data = [
            'fullname' => $request->information['fullname'],
            'birthdate' => $request->information['birthdate'],
            'gender' => $request->information['gender'],
            'desired_position' => $request->information['desired_position'],
            'current_position' => $request->information['current_position'],
            'desired_country' => $request->information['desired_country'],
            'desired_city' => $request->information['desired_city'],
            'more_info' => $request->information['more_info'],
        ];


      $seeker_info= SeekerInformation::create($data);
        

        $links = [
            'website' => $request->information['social_links']['website'],
            'instagram' => $request->information['social_links']['instagram'],
            'linkedin' => $request->information['social_links']['linkedin'],
            'facebook' => $request->information['social_links']['facebook'],
            'twitter' => $request->information['social_links']['twitter'],
            'pinterest' => $request->information['social_links']['pinterest'],
            'youtube' => $request->information['social_links']['youtube'],
            'tik_tok' => $request->information['social_links']['tiktok'],
            'user_type_id' => Auth::user()->id,
        ];


       $social_links= SocialLinks::create($links);


        for ($i = 0; $i < count($request->experience); $i++) {
            $date=$request->experience[$i]['date']['day'].'-'.$request->experience[$i]['date']['month'].'-'.$request->experience[$i]['date']['year'];
            $end_date=$request->experience[$i]['finishDate']['day'].'-'.$request->experience[$i]['finishDate']['month'].'-'.$request->experience[$i]['finishDate']['year'];
            Experience::create([
                'user_id' => Auth::user()->id,
                'position' => $request->experience[$i]['position'],
                'start_date' => date('Y-m-d', strtotime($date)),
                'end_date' => date('Y-m-d', strtotime($end_date)),
                'establishment' => $request->experience[$i]['establishment'],
                'more_info' => $request->experience[$i]['info'],

            ]);
        }

        for ($i = 0; $i < count($request->education); $i++) {
            $date=$request->education[$i]['date']['day'].'-'.$request->education[$i]['date']['month'].'-'.$request->education[$i]['date']['year'];
            Education::create([
                'user_id' => Auth::user()->id,
                // 'establishment' => $request->education[$i]['establishment'],
                'establishment' =>'ok',
                'certification_type' => $request->education[$i]['certification'],
                'field_of_study' => $request->education[$i]['studyField'],
                'graduation_date' => date('Y-m-d', strtotime($date)),
            ]);
        }

        return response()->json(['data'=>$seeker_info]);

   
    }


    public function getPositions($position){
        $positions=DB::table('positions')->where('name', 'like', '%' .  $position . '%')->orWhere('slug', 'like', '%' .  $position . '%')->get();

        return response()->json($positions);
    }
}
