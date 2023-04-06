<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Establishment;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {

        $date = Carbon::today()->subDays(30);
        $establishments = Establishment::where('created_at', '>=', $date)->count();
        $jobs = Job::where('created_at', '>=', $date)->count();
        $users = User::where('created_at', '>=', $date)->count();
        $stats = [
            'establishemnt' => number_format($establishments),
            'jobs' => number_format($jobs),
            'users' => number_format($users),
        ];

        return response()->json($stats);
    }
}
