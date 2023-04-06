<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function recruiterRating(Request $request, Rating $rating)
    {
        if (isset($rating->id) && $rating->role_id == 1){
            $rating->update([
                'users' => $rating->users + 1,
                'rating' => ($rating->rating + $request->rating) / 2,
            ]);
        } else if ($request->role_id == 1) {
            Rating::create([
                'role_id' => $request->role_id,
                'data_id' => $request->data_id,
                'users' => 1,
                'rating' => $request->rating,
            ]);

        }
    }

    public function establishmentRating(Request $request, Rating $rating)
    {
        if (isset($rating->id) && $rating->role_id == 2){
            $rating->update([
                'users' => $rating->users + 1,
                'rating' => ($rating->rating + $request->rating) / 2,
            ]);
        } else if ($request->role_id == 2){
            Rating::create([
                'role_id' => $request->role_id,
                'data_id' => $request->data_id,
                'users' => 1,
                'rating' => $request->rating,
            ]);

        }
}


}
