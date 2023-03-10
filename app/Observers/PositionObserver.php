<?php

namespace App\Observers;

use App\Models\Position;
use Illuminate\Support\Facades\Cache;

class SubcategoryObserver
{
    public function created(Position $subcategory): void
    {
        Cache::forget('subcategories');
    }

    public function updated(Position $subcategory): void
    {
        Cache::forget('subcategories');
    }

    public function deleted(Position $subcategory): void
    {
        Cache::forget('subcategories');
    }
}
