## Manual installation
1. ```composer clearcache```
1. ```composer install```
1. ```php artisan cache:clear && php artisan route:clear && php artisan route:trans:clear && php artisan view:clear && php artisan clear-compiled```
1. ```php artisan migrate``` \
to work correctly, you need to set up the cron task:
1. ```/usr/local/bin/php /var/www/html/artisan check:subscription >/dev/null 2>&1```

## Export translatable strings
```php artisan translatable:export <lang>``` \
Where <lang> is a language code, or a comma-separated list of language codes.
For example: 
```
php artisan translatable:export es
php artisan translatable:export es,bg,de
```
AND for JS: \
```php artisan lang:js``` \
or compressing the JS file: \
```php artisan lang:js -c``` 

## Caching & optimization
configuration caching 
```
php artisan cache:clear
php artisan config:cache
```
caching routes 
```
php artisan route:clear
php artisan route:cache
```
fixed problem with mcamara translate routes [(detail)](https://github.com/czim/laravel-localization-route-cache): 
```
php artisan route:trans:clear
php artisan route:trans:cache
``` 

Optimize Autoload 
```
composer dumpautoload -o
dump-autoload –optimize
```

#### Configuration Dashboard module
configurations that override the behavior of extensions: "breadcrumbs" and "paginator" are located on the path: \
```Module/Dashboard/Providers/ConfigurationServiceProvider``` in method ```boot```
