<?php

use Illuminate\Support\Facades\Artisan;

//cron handler for free hosting
Route::any('check-subscription/{secret}/handle', function ($secret) {
    Artisan::call('check:subscription');
})->where('secret', env('API_HANDLER_SECRET_KEY', 'default'));
