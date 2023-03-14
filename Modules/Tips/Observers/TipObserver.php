<?php

namespace Modules\Tips\Observers;

use Illuminate\Support\Facades\Cache;
use Modules\Tips\Entities\Tip;

class TipObserver
{
    public function created(Tip $tip): void
    {
        Cache::forget('tips');
    }

    public function updated(Tip $tip): void
    {
        Cache::forget('tips');
    }

    public function deleted(Tip $tip): void
    {
        Cache::forget('tips');
    }
}
