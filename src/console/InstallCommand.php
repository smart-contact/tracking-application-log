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
        $this->callSilent('vendor:publish', ['--tag' => 'application-log-provider']);

        $this->info('Tracking Application Log scaffolding installed successfully.');
    }
}