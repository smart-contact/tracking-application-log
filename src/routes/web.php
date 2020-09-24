<?php

Route::namespace('SmartContact\TrackingApplicationLog\app\Http\Controllers')
    ->group(function() {
        Route::get('application-logs', 'ApplicationLogController@index')->name('application_logs.index');
        Route::get('application-logs/{application_log}', 'ApplicationLogController@show')->name('application_logs.show');
    });
