<?php

namespace App\Observers;

use App\Models\Job;
use Illuminate\Support\Facades\Cache;

class JobObserver
{
    public function created(Job $job): void
    {
        Cache::forget('jobs');
    }

    public function updated(Job $job): void
    {
        Cache::forget('jobs');
    }

    public function deleted(Job $job): void
    {
        Cache::forget('jobs');
    }
}
