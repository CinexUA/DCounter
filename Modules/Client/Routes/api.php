<?php

Route::group(['prefix' => 'client'], function($r) {
    $r->post('/auth', 'AuthController@getToken');
    $r->post('/clients', 'AuthController@getClients');
    $r->post('/{rememberToken}/payment-history', 'ClientController@getPaymentHistory');
});
