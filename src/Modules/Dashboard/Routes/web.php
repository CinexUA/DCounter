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

});

