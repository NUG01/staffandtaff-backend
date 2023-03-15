<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class JobController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return JobResource::collection(Cache::remember('jobs', 60 * 60 * 24, function () {
            return Job::all();
        }));
    }

    /**
     * @throws AuthorizationException
     */
    public function store(JobRequest $request): JobResource
    {
        $this->authorize('recruiter', Auth()->user());

        $ad = Job::create($request->validated());
        JobResource::createImages($ad, $request);

        return JobResource::make($ad);
    }

    public function show(Job $job): JobResource
    {
        return JobResource::make($job);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Job $job, JobRequest $request): JobResource
    {
        $this->authorize('recruiter', Auth()->user());

        $updated = $job->update($request->validated());

        return JobResource::make($updated);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Job $job): AnonymousResourceCollection
    {
        $this->authorize('recruiter', Auth()->user());

        $job->delete();

        return JobResource::collection(Cache::remember('jobs', 60 * 60 * 24, function () {
            return Job::all();
        }));
    }
}
