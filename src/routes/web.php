<?php

Route::namespace('SmartContact\TrackingApplicationLog\app\Http\Controllers\Web')
    ->group(function() {
        Route::get('application-logs', 'HomeController@index');
    });
