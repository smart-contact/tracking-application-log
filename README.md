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

Finally, on the root of project, do this command
```
php artisan migrate
```