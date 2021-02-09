## Export translatable strings
```php artisan translatable:export <lang>``` \
Where <lang> is a language code or a comma-separated list of language codes.
For example: 
```
php artisan translatable:export es
php artisan translatable:export es,bg,de
```

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
