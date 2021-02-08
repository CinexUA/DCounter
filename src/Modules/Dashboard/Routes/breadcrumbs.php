<?php

$lang = function ($key){
    return __("dashboard::breadcrumbs.{$key}");
};

Breadcrumbs::for('dashboard', function ($trail) use($lang) {
    $trail->push($lang('dashboard_link'), route('dashboard.index'));
});
