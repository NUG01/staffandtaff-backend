<?php

namespace Modules\Tips\Observers;

use Illuminate\Support\Facades\Cache;
use Modules\Tips\Entities\Category;

class CategoryObserver
{
    public function created(Category $category): void
    {
        Cache::forget('categories');
    }

    public function updated(Category $category): void
    {
        Cache::forget('categories');
    }

    public function deleted(Category $category): void
    {
        Cache::forget('categories');
    }
}
