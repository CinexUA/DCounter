<?php

/*Route::namespace('\Modules\Client\Http\Controllers')->group(function () {
    Route::get('/{any}', 'ClientController@index')->where('any', '.*');
});*/

Route::get('/{any}', 'ClientController@index')->where('any', '.*');
