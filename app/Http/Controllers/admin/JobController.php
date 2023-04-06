<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\admin\JobResource;
use App\Models\Establishment;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        return JobResource::collection(Job::all());
    }

    public function jobDetails(Job $job)
    {

        $jobData = [
            'establishment_name' => $job->establishment->name,
            'position' => $job->position,
            'salary' => $job->salary,
            'currenct' => $job->currency,
        ];

        return response()->json($jobData);
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return JobResource::collection(Job::all());
    }
}
