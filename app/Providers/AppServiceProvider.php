<?php

namespace App\Providers;

use App\Models\Profile;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrapFive();

        $profile = null;
        if (Schema::hasTable('profiles')) {
            $profile = Profile::query()->first();
        }

        View::share('siteProfile', $profile);
    }
}
