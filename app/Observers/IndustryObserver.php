<?php

namespace App\Observers;

use App\Models\Industry;
use Illuminate\Support\Facades\Cache;

class IndustryObserver
{
    public function created(Industry $category): void
    {
        Cache::forget('industries');
    }

    public function updated(Industry $category): void
    {
        Cache::forget('industries');
    }

    public function deleted(Industry $category): void
    {
        Cache::forget('industries');
    }
}
