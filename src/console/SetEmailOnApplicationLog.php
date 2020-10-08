<?php

namespace SmartContact\TrackingApplicationLog\Console;

use Illuminate\Console\Command;
use SmartContact\TrackingApplicationLog\app\Models\ApplicationLog;

class SetEmailOnApplicationLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tracking-application-log:assign-email';

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
        $applicationLogs = ApplicationLog::all();

        foreach($applicationLogs as $applicationLog)
        {
            if(is_null($applicationLog->email)) {
                $email = $applicationLog->actor ? $applicationLog->actor->email : '-';
                $applicationLog->email = $email;
                $applicationLog->save();
            }
        }
    }
}
