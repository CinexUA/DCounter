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
        $r->get('{company}/clients', ['as'=>'index','uses'=>'ClientsController@index']);
        $r->get('{company}/client/create', ['as'=>'create','uses'=>'ClientsController@create']);
        $r->get('{company}/client/{client}', ['as'=>'show','uses'=>'ClientsController@show']);
        $r->post('{company}/client', ['as'=>'store','uses'=>'ClientsController@store']);
        $r->get('{company}/client/{client}/edit', ['as'=>'edit','uses'=>'ClientsController@edit']);
        $r->patch('client/{client}', ['as'=>'update','uses'=>'ClientsController@update']);
        $r->delete('client/{client}', ['as'=>'destroy','uses'=>'ClientsController@destroy']);
    });
    //endregion company clients


});

