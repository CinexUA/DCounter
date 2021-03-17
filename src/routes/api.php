<?php

use Illuminate\Support\Facades\Artisan;

//cron for free hosting
Route::get('check-subscription/{secret}/handle', function ($secret) {
    Artisan::call('check:subscription');
})->where('secret', env('API_HANDLER_SECRET_KEY', 'default'));
