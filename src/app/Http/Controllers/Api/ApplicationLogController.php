<?php

namespace SmartContact\TrackingApplicationLog\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use SmartContact\TrackingApplicationLog\app\Exports\UsersExport;
use SmartContact\TrackingApplicationLog\app\Jobs\ApplicationLogExportJob;
use SmartContact\TrackingApplicationLog\app\Models\ApplicationLog;

class ApplicationLogController extends ApiBaseController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function retrieveLogs()
    {
        $request = request('q');
        $applicationLogs = ApplicationLog::where('email', 'like', "%{$request}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $applicationLogs;
    }

    /**
     * @param $application_log
     * @return mixed
     */
    public function show($applicationLog)
    {
        return ApplicationLog::find($applicationLog);
    }

    public function download()
    {   
        $settings = [
            'exportFormat' => request()->exportFormat ?? 'xlsx',
            'fromDate' => request()->fromDate,
            '$toDate' => request()->toDate
        ];
        
        ApplicationLogExportJob::dispatch($settings);
    }
}
