<?php

namespace SmartContact\TrackingApplicationLog\app\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ApplicationLog extends Model
{
    protected $fillable = [
        'actor_id',
        'subject',
        'subject_link',
        'description',
        'log',
        'changes',
        'level',
        'user_agent',
        'browser',
        'browser_version',
        'platform',
        'platform_version',
        'ip',
        'email'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function actor()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    /**
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Europe/Rome')->format('d-m-Y H:i');
    }
}
