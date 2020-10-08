# Tracking Application Log

## Installation

```
composer require smart-contact/tracking-application-log
```

```
php artisan tracking-application-log:install
```

```
php artisan migrate
```

## Define access
protected function gate()
    {
        Gate::define('', function ($user) {
            /**
             * TODO Create your own policy logic
             */
        });
    }
```