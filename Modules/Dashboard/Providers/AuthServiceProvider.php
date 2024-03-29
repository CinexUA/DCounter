<?php

namespace Modules\Dashboard\Providers;

use App\Models\Client;
use App\Models\Company;
use App\Models\CronLog;
use App\Models\Currency;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Dashboard\Policies\ClientPolicy;
use Modules\Dashboard\Policies\CompanyPolicy;
use Modules\Dashboard\Policies\CronLogPolicy;
use Modules\Dashboard\Policies\CurrencyPolicy;
use Modules\Dashboard\Policies\PermissionPolicy;
use Modules\Dashboard\Policies\RolePolicy;
use Modules\Dashboard\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Company::class => CompanyPolicy::class,
        Client::class => ClientPolicy::class,
        Currency::class => CurrencyPolicy::class,
        CronLog::class => CronLogPolicy::class,
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    public function boot()
    {
        $this->registerPolicies();
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
