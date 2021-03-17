<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/dashboard',
        'as' => 'dashboard.',
        'middleware' => [
            'localizationRedirect',
            'localeViewPath',
            'auth',
            'verified',
        ]
    ], function ($r){

    $r->get('/', 'DashboardController@index')->name('index');
    $r->post('/simulation-passed-day', 'DashboardController@simulationPassedDay')
        ->name('simulation.passed.day');
    $r->resource('profile', 'ProfileController')->only(['edit', 'update']);

    $r->group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:administrator']], function($r) {
        $r->resource('users', 'UsersController');
        $r->resource('roles', 'RolesController')->only(['index', 'show', 'edit', 'update']);
        $r->resource('permissions', 'PermissionsController')->only(['index', 'show', 'edit', 'update']);
        $r->resource('cron-logs', 'CronLogController')->only('index');
        $r->get('make-dump-db', 'DashboardController@dbDump')->name('db.dump');
    });

    $r->resource('companies', 'CompaniesController');

    $r->put(
        'client/{client}/calculate-days-for-next-month',
        'CompanyClientsController@calculateDaysForNextMonth'
    )->name('client.calculateDaysForNextMonth');
    $r->resource('company.clients', 'CompanyClientsController');

    $r->get('company/{company}/client-wallet/{client}/transactions',
        ['as' => 'client-wallet.transactions', 'uses' => 'ClientWalletController@transactions']
    );
    $r->resource('client-wallet', 'ClientWalletController')
        ->only(['edit', 'update'])
        ->parameters([
            'client-wallet' => 'client'
        ]);

});
