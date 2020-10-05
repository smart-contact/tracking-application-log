<?php

namespace SmartContact\TrackingApplicationLog\app\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('tracking-application-log::home');
    }
}
