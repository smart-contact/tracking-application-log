<?php

namespace SmartContact\TrackingApplicationLog;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use SmartContact\TrackingApplicationLog\Console\DeleteApplicationLogFile;
use SmartContact\TrackingApplicationLog\Console\InstallCommand;
use SmartContact\TrackingApplicationLog\Console\SetEmailOnApplicationLog;

class TrackingApplicationLogProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            Console\InstallCommand::class,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/routes.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'tracking-application-log');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
                __DIR__.'/../public' => public_path('vendor/tracking-application-log'),
            ], 'tracking-application-log-assets');

        $this->publishes([
            __DIR__ . "/stubs/TrackingApplicationLogProvider.stub"=> app_path('Providers/TrackingApplicationLogProvider.php'),
        ], 'tracking-application-log');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                SetEmailOnApplicationLog::class,
                DeleteApplicationLogFile::class,
            ]);
        }
        $this->app->booted(function () {
            $schedule = app(Schedule::class);
            $schedule->command('tracking-application-log:delete-application-log-file')->daily();
        });
    }
}
