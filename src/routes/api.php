<?php

use Illuminate\Support\Facades\Artisan;

//cron for free hosting
Route::get('check-subscription/{secret}/handle', function ($secret) {
    Artisan::call('check:subscription');
})->where('secret', 'dGVzdCB0ZXh0IGZvciBlbmNvZGluZyA5NjQ4');
