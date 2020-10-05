<?php

namespace SmartContact\TrackingApplicationLog\Console;

use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tracking-application-log:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the Application Log resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Publishing Tracking Application Log Service Provider...');
        $this->callSilent('vendor:publish', ['--tag' => 'tracking-application-log']);

        $this->comment('Publishing Tracking Application Log Assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'tracking-application-log-assets']);
        
        $this->registerTrackingApplicationLogProvider();

        $this->info('Tracking Application Log scaffolding installed successfully.');
    }

    protected function registerTrackingApplicationLogProvider()
    {
        $namespace = Str::replaceLast('\\', '', $this->laravel->getNamespace());

        $appConfig = file_get_contents(config_path('app.php'));

        if (Str::contains($appConfig, $namespace . '\\Providers\\TrackingApplicationLogProvider::class')) {
            return;
        }

        $lineEndingCount = [
            "\r\n" => substr_count($appConfig, "\r\n"),
            "\r" => substr_count($appConfig, "\r"),
            "\n" => substr_count($appConfig, "\n"),
        ];

        $eol = array_keys($lineEndingCount, max($lineEndingCount))[0];

        file_put_contents(config_path('app.php'), str_replace(
            "{$namespace}\\Providers\RouteServiceProvider::class,".$eol,
            "{$namespace}\\Providers\RouteServiceProvider::class,".$eol."        {$namespace}\Providers\TrackingApplicationLogProvider::class,".$eol,
            $appConfig
        ));

        file_put_contents(app_path('Providers/TrackingApplicationLogProvider.php'), str_replace(
            "namespace App\Providers;",
            "namespace {$namespace}\Providers;",
            file_get_contents(app_path('Providers/TrackingApplicationLogProvider.php'))
        ));
    }
}
