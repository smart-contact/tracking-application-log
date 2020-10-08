<?php

namespace SmartContact\TrackingApplicationLog\app\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportLog extends Model
{
    public static $STATES = [
        'STARTED' => 'started',
        'COMPLETED' => 'completed',
        'ERROR' => 'error'
    ];

    protected $fillable = [
        'user_id',
        'status',
        'model',
        'url'
    ];

     /**
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Europe/Rome')->format('d-m-Y H:i');
    }
}
