<?php

namespace App\Providers;

use App\Models\Peralatan;
use App\Observers\PeralatanObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        // Peralatan::observe(PeralatanObserver::class);
    }
}
