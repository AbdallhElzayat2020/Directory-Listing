<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use App\Observers\CategoryObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // set dynamically timezone from settings table
//        $timezone = Setting::where('key', 'site_default_timezone')->first();
//        config()->set(['app.timezone' => $timezone->value]);


        // register the observer for the Category model
        Category::observe(CategoryObserver::class);
    }
}
