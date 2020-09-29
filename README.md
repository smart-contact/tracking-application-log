# Tracking Application Log

## Installation

```
composer require smart-contact/tracking-application-log
```

Go up
```
/app/config.php
```

and add inside 'providers' the package's reference
```
'providers' => [
    ...

    \SmartContact\TrackingApplicationLog\TrackingApplicationLogProvider::class,
    
    ...
```

On the root of project, do this command for create the application_logs table
```
php artisan migrate
```

On the root of project, do this command for create the TrackingApplicationLogProvider.php file.
```
php artisan tracking-application-log:install
```
On TrackingApplicationLogProvider.php you can create your own policy logic in the gate() method.
```
protected function gate()
    {
        Gate::define('application_logs', function ($user) {
            /**
             * TODO Create your own policy logic
             */
        });
    }
```