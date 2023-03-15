<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\Industry;
use App\Models\Position;
use App\Observers\JobObserver;
use App\Observers\IndustryObserver;
use App\Observers\PositionObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // For Caching
        Job::observe(JobObserver::class);
        Industry::observe(IndustryObserver::class);
        Position::observe(PositionObserver::class);
    }
}
