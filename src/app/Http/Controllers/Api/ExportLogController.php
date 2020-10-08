<?php

namespace SmartContact\TrackingApplicationLog\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SmartContact\TrackingApplicationLog\app\Models\ExportLog;

class ExportLogController extends ApiBaseController
{
    public function retrieveExportLogs()
    {
        $userId = request()->header('userId');
        return ExportLog::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate(10);
    }
}
