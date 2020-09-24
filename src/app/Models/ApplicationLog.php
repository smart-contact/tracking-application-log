<?php

namespace SmartContact\TrackingApplicationLog\app\Models;

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
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function actor()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function subject()
    {
        return $this->morphTo();
    }
}
