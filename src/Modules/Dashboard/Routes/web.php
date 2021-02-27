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
    $r->resource('profile', 'ProfileController')->only(['edit', 'update']);

    $r->group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:administrator']], function($r) {
        $r->resource('users', 'UsersController');
        $r->resource('roles', 'RolesController')->only(['index', 'show', 'edit', 'update']);
        $r->resource('permissions', 'PermissionsController')->only(['index', 'show', 'edit', 'update']);
    });

    $r->resource('companies', 'CompaniesController');

    //region company clients
    $r->group(['prefix' => 'company', 'as' => 'company.clients.'], function ($r){
        $r->get('{company}/clients', ['as'=>'index','uses'=>'CompanyClientsController@index']);
        $r->get('{company}/client/create', ['as'=>'create','uses'=>'CompanyClientsController@create']);
        $r->get('{company}/client/{client}', ['as'=>'show','uses'=>'CompanyClientsController@show']);
        $r->post('{company}/client', ['as'=>'store','uses'=>'CompanyClientsController@store']);
        $r->get('{company}/client/{client}/edit', ['as'=>'edit','uses'=>'CompanyClientsController@edit']);
        $r->patch('client/{client}', ['as'=>'update','uses'=>'CompanyClientsController@update']);
        $r->delete('client/{client}', ['as'=>'destroy','uses'=>'CompanyClientsController@destroy']);
    });
    //endregion company clients

    $r->get('company/{company}/client-wallet/{client}/transactions',
        ['as' => 'client-wallet.transactions', 'uses' => 'ClientWalletController@transactions']
    );
    $r->resource('client-wallet', 'ClientWalletController')
        ->only(['edit', 'update'])
        ->parameters([
            'client-wallet' => 'client'
        ]);

});

