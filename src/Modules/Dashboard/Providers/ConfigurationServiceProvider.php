<?php

namespace Modules\Dashboard\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class ConfigurationServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        config()->set('breadcrumbs.view', 'dashboard::partials/breadcrumbs');
        config()->set('breadcrumbs.files', base_path('Modules/Dashboard/Routes/breadcrumbs.php'));
        config()->set('eloquentfilter.namespace', 'Modules\\Dashboard\\Filters\\');

        Paginator::defaultView('dashboard::vendor/pagination/bootstrap-4');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
