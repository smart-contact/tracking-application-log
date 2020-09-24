<?php

namespace SmartContact\TrackingApplicationLog;

use Illuminate\Support\ServiceProvider;

class TrackingApplicationLogProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'tracking-application-log');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
}
