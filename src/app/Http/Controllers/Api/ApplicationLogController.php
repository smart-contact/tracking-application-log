<?php

namespace SmartContact\TrackingApplicationLog\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use SmartContact\TrackingApplicationLog\app\Models\ApplicationLog;

class ApplicationLogController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $request = request('q');
        $applicationLogs = ApplicationLog::where('description', 'like', "%{$request}%")
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('tracking-application-log::application-log.index', compact('applicationLogs'));
    }

    /**
     * @param $application_log
     * @return mixed
     */
    public function show($application_log)
    {
        $applicationLog =  ApplicationLog::find($application_log);
        return view('tracking-application-log::application-log.show', compact('applicationLog'));
    }
}
