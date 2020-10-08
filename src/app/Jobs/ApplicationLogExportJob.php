<?php

namespace SmartContact\TrackingApplicationLog\app\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use SmartContact\TrackingApplicationLog\app\Exports\ApplicationLogsExport;
use SmartContact\TrackingApplicationLog\app\Models\ExportLog;

class ApplicationLogExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $settings;
    private $fileName;
    private $path;
    private $url;
    private $exportLog;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($settings)
    {
        $this->settings = $settings;
        $this->fileName = 'application-logs_' . now()->timestamp . '.' . $settings['exportFormat'];
        $this->path = 'public/application-logs/' . $this->fileName;
        $this->url = 'storage/application-logs/' . $this->fileName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->exportLog = $this->createExportLog();
        Excel::store(new ApplicationLogsExport($this->settings), $this->path);
        $this->updateExportLog();
    }
 
    private function createExportLog()
    {
        return ExportLog::create([
            'user_id' => 1,
            'model' => 'ApplicationLog',
            'status' => ExportLog::$STATES['STARTED']
        ]);
    }

    private function updateExportLog()
    {
        $this->exportLog->update([
            'status' => ExportLog::$STATES['COMPLETED'],
            'url' => $this->url
        ]);
    }


}
