<?php

if (!function_exists('set_active')) {
    function set_active($path)
    {
        //return (strpos(Route::currentRouteName(), $path) == 0) ? 'active' : '';
        return request()->routeIs($path) ? 'active' : '';
    }
}
