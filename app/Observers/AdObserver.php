<?php

namespace App\Observers;

use App\Models\Ad;
use Illuminate\Support\Facades\Cache;

class AdObserver
{
    public function created(Ad $ad): void
    {
        Cache::forget('ads');
    }

    public function updated(Ad $ad): void
    {
        Cache::forget('ads');
    }

    public function deleted(Ad $ad): void
    {
        Cache::forget('ads');
    }
}
