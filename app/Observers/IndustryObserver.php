<?php

namespace App\Observers;

use App\Models\Industry;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    public function created(Industry $category): void
    {
        Cache::forget('categories');
    }

    public function updated(Industry $category): void
    {
        Cache::forget('categories');
    }

    public function deleted(Industry $category): void
    {
        Cache::forget('categories');
    }
}
