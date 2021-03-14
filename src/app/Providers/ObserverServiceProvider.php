<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use App\Observers\ClientObserver;
use App\Observers\CompanyObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Client::observe(ClientObserver::class);
        Company::observe(CompanyObserver::class);
        User::observe(UserObserver::class);
    }
}
