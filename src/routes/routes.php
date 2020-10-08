<?php

Route::namespace('SmartContact\TrackingApplicationLog\app\Http\Controllers\Web')
    ->middleware(["web", "auth", "can:view"])
    ->group(function() {
        Route::get('/application-logs', 'HomeController@index');
    });

Route::namespace('SmartContact\TrackingApplicationLog\app\Http\Controllers\Api')
    ->prefix('api/application-logs')    ->group(function() {
        Route::get('/logs', 'ApplicationLogController@retrieveLogs');
        Route::get('/logs/download', 'ApplicationLogController@download');
        Route::get('/logs/{applicationLog}', 'ApplicationLogController@show');
        Route::get('/export-logs', 'ExportLogController@retrieveExportLogs');
    });