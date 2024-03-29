<p align="center"><img src="https://raw.githubusercontent.com/CinexUA/DCounter/master/DCLogo.png" width="128"></p>
## About DCounter
DCounter is a calculator that helps you keep track of the monthly payment of users for providing various types of services.

## Project setup

1. Clone repo
1. `composer install`
1. `cp .env.example .env`
1. `php artisan key:generate`
1. Add details to `.env` file
1. `php artisan migrate`
1. `php artisan storage:link`
1. Make sure `storage/app/public` and `bootstrap/cache` is read and writable
##### to work correctly, you need to set up the cron task once a day:
1. ```/usr/local/bin/php /var/www/html/artisan check:subscription >/dev/null 2>&1``` or ```http://localhost/api/check-subscription/dGVzdCB0ZXh0IGZvciBlbmNvZGluZyA5NjQ4/handle``` (for free hosting. you need change secret key API_HANDLER_SECRET_KEY in .env for production)
1. Cron for negative balance notification ```/usr/local/bin/php /var/www/html/artisan notifications:negative-balance >/dev/null 2>&1```
1. A backup DB (optional): ```/usr/local/bin/php /var/www/html/artisan backup:db --by=email >/dev/null 2>&1``` (you need to define DB_BACKUP_EMAIL in .env if selected backup by email )

## Deployment
1. ```composer install --no-interaction --quiet --no-dev --prefer-dist --classmap-authoritative```

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
