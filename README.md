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
```
protected function gate()
    {
        Gate::define('view', function ($user) {
            //here you can define access
        });
    }
```

## Add LaravelExcel
On config/app.php add this lines:
```
'providers' => [
    ...
    Maatwebsite\Excel\ExcelServiceProvider::class,
    ...
]
```
```
'aliases' => [
    ...
   'Excel' => Maatwebsite\Excel\Facades\Excel::class,
   ...
]
```