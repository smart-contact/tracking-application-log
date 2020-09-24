<?php

namespace SmartContact\TrackingApplicationLog\app\Models\Traits;


use App\Http\Controllers\Auth\LoginController;
use Jenssegers\Agent\Agent;
use ReflectionClass;
use SmartContact\TrackingApplicationLog\app\Models\ApplicationLog;

trait TrackingApplicationLogs
{
    /**
     *
     */
    protected static function boot()
    {
        parent::boot();

        foreach(static::getModelEvents() as $event) {
            static::$event(function($model) use($event) {
                $model->registerApplicationLog($event);
            });
        }
    }

    /**
     * @return mixed
     */
    public function lastApplicationLogs()
    {
        return $this->applicationLogs()->orderBy('created_at', 'desc')->take(10);
    }

    /**
     * Fetch the changes to the model.
     *
     * @return array|null
     */
    public function applicationLogsChanges()
    {
        $original = $this->getOriginal();

        foreach ($original as $key => $value) {
            if(is_array($value) or is_object($value)) {
                $original[$key] = json_encode($value);
            }
        }

        $attributes = $this->getAttributes();

        if ($this->wasChanged()) {
            return [
                'before' => Arr::except(array_diff($original, $attributes), ['created_at','updated_at']),
                'after' => Arr::except($this->getChanges(), ['created_at','updated_at']),
            ];
        }

        return [];
    }

    /**
     * @param null $event
     * @param null $baseInfoUserArray
     * @throws \ReflectionException
     */
    protected function registerApplicationLog($event = null, $baseInfoUserArray = null)
    {
        if(!isset($baseInfoUserArray)){
            $baseInfoUserArray = [
                'level' => 'info',
                'description' => $this->getApplicationLogDescription($this, $event),
                'changes' => json_decode($this->applicationLogsChanges()),
                'actor_id' => auth()->user()->id ?? null,
                'subject' => strtolower((new ReflectionClass($this))->getShortName())
            ];
        }

        $getAgent = getAgent();

        $registerNewLogin = array_merge($baseInfoUserArray, $getAgent);
        ApplicationLog::create($registerNewLogin);
    }

    /**
     * @param $model
     * @param $action
     * @return string
     * @throws \ReflectionException
     */
    protected function getApplicationLogDescription($model, $action)
    {
        $description = strtolower((new ReflectionClass($model))->getShortName());

        return "{$action}_{$description}";
    }

    /**
     * @return string[]
     */
    protected static function getModelEvents()
    {
        if(isset(static::$recordEvents)) {
            return static::$recordEvents;
        }

        return ['created', 'deleted', 'updated'];
    }

    /**
     *
     */
    public function trackingUserLogin($email)
    {
        $baseInfoUserArray = [
            'level' => 'info',
            'description' => "new_user_login",
            'log' => json_encode([
                'user_email' => $email
            ]),
            'subject' => 'LoginController'
        ];

        $this->registerApplicationLog(null, $baseInfoUserArray);
    }
}
