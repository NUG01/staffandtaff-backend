<?php

namespace App\Observers;

use App\Models\Position;
use Illuminate\Support\Facades\Cache;

class PositionObserver
{
    public function created(Position $subcategory): void
    {
        Cache::forget('positions');
    }

    public function updated(Position $subcategory): void
    {
        Cache::forget('positions');
    }

    public function deleted(Position $subcategory): void
    {
        Cache::forget('positions');
    }
}
