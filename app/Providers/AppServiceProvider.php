<?php

namespace App\Providers;

use App\Broadcasting\SmsChannel;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            //providers
            if (class_exists(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class)) {
                $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            }

            if (class_exists(\Barryvdh\Debugbar\ServiceProvider::class)) {
                $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            }

            $loader = AliasLoader::getInstance();
            //alias

            if (class_exists(\Barryvdh\Debugbar\Facade::class)) {
                $loader->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
            }

        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Notification::extend('sms', function ($app) {
            return new SmsChannel();
        });
    }
}
