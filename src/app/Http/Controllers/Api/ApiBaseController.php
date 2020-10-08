<?php

namespace SmartContact\TrackingApplicationLog\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiBaseController extends Controller
{
    public function __construct()
    {
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c';
        $authorization = request()->header('Authorization');
        
        if(! $authorization || $authorization != $token) {
            abort(401);
        }
    }
}
