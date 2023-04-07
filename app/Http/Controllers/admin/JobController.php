<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UpdateJobRequest;
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
            'currency' => $job->currency,
            'contract' => $job->type_of_contract,
            'attendance' => $job->type_of_attendance,
            'period' => $job->period_type,
            'availability' => $job->availability,
            'description' => $job->description,
            'location' => [
                'country_code' => $job->country_code,
                'city' => $job->city_name,
                'longitude' => $job->longitude,
                'latitude' => $job->latitude,
            ],
        ];

        return response()->json($jobData);
    }

    public function update(UpdateJobRequest $request)
    {
        $est = Establishment::where('name', $request->establishment)->first();
        if (!$est) return response()->json(['message' => 'Establishment with given name does not exist!'], 400);

        Job::where('id', $request->id)->update([
            'establishment_id' => $est->id,
            'position' => $request->position,
            'salary' => $request->salary,
            'currency' => $request->currency,
            'type_of_contract' => $request->contract,
            'type_of_attendance' => $request->attendance,
            'period_type' => $request->period,
            'availability' => $request->availability,
            'description' => $request->description,
            'country_code' => $request->country_code,
            'city_name' => $request->city,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);
        return response()->json(['message' => 'Job updated successfully!']);
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return JobResource::collection(Job::all());
    }
}
