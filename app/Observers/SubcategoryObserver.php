<?php

namespace App\Observers;

use App\Models\Subcategory;
use Illuminate\Support\Facades\Cache;

class SubcategoryObserver
{
    public function created(Subcategory $subcategory): void
    {
        Cache::forget('subcategories');
    }

    public function updated(Subcategory $subcategory): void
    {
        Cache::forget('subcategories');
    }

    public function deleted(Subcategory $subcategory): void
    {
        Cache::forget('subcategories');
    }
}
