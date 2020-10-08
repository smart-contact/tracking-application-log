<?php

namespace SmartContact\TrackingApplicationLog\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use SmartContact\TrackingApplicationLog\app\Models\ApplicationLog;
use SmartContact\TrackingApplicationLog\app\Models\ExportLog;

class DeleteApplicationLogFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tracking-application-log:delete-application-log-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        File::deleteDirectory(storage_path('app/public/application-logs'));
        ExportLog::whereNotNull('url')->update(['url' => null]);
    }
}
