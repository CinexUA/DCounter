<?php

$trans = function ($key){
    return trans("dashboard::breadcrumbs.{$key}");
};

Breadcrumbs::for('dashboard', function ($trail) use($trans) {
    $trail->push($trans('dashboard_link'), route('dashboard.index'));
});

//region admin users
Breadcrumbs::for('admin.users.index', function ($trail) use($trans) {
    $trail->parent('dashboard');
    $trail->push($trans('users_index_link'), route('dashboard.admin.users.index'));
});

Breadcrumbs::for('admin.users.show', function ($trail, $user) use($trans) {
    $trail->parent('admin.users.index');
    $trail->push($trans('user_show_link'), route('dashboard.admin.users.show', $user));
});

Breadcrumbs::for('admin.users.create', function ($trail) use($trans) {
    $trail->parent('admin.users.index');
    $trail->push($trans('user_create_link'), route('dashboard.admin.users.create'));
});

Breadcrumbs::for('admin.users.edit', function ($trail, $user) use($trans) {
    $trail->parent('admin.users.index');
    $trail->push($trans('user_edit_link'), route('dashboard.admin.users.edit', $user));
});
//endregion admin users
