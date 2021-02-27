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

//region admin roles
Breadcrumbs::for('admin.roles.index', function ($trail) use($trans) {
    $trail->parent('dashboard');
    $trail->push($trans('roles_index_link'), route('dashboard.admin.roles.index'));
});

Breadcrumbs::for('admin.roles.show', function ($trail, $role) use($trans) {
    $trail->parent('admin.roles.index');
    $trail->push($trans('role_show_link'), route('dashboard.admin.roles.show', $role));
});

Breadcrumbs::for('admin.roles.edit', function ($trail, $role) use($trans) {
    $trail->parent('admin.roles.index');
    $trail->push($trans('role_edit_link'), route('dashboard.admin.roles.edit', $role));
});
//endregion admin roles

//region admin permissions
Breadcrumbs::for('admin.permissions.index', function ($trail) use($trans) {
    $trail->parent('dashboard');
    $trail->push($trans('permissions_index_link'), route('dashboard.admin.permissions.index'));
});

Breadcrumbs::for('admin.permissions.show', function ($trail, $permission) use($trans) {
    $trail->parent('admin.permissions.index');
    $trail->push($trans('permission_show_link'), route('dashboard.admin.permissions.show', $permission));
});

Breadcrumbs::for('admin.permissions.edit', function ($trail, $permission) use($trans) {
    $trail->parent('admin.permissions.index');
    $trail->push($trans('permission_edit_link'), route('dashboard.admin.permissions.edit', $permission));
});
//endregion admin permissions

//region companies
Breadcrumbs::for('companies.index', function ($trail) use($trans) {
    $trail->parent('dashboard');
    $trail->push($trans('company_index_link'), route('dashboard.companies.index'));
});

Breadcrumbs::for('companies.show', function ($trail, $company) use($trans) {
    $trail->parent('companies.index');
    $trail->push($trans('company_show_link'), route('dashboard.companies.show', $company));
});

Breadcrumbs::for('companies.create', function ($trail) use($trans) {
    $trail->parent('companies.index');
    $trail->push($trans('company_create_link'), route('dashboard.companies.create'));
});

Breadcrumbs::for('companies.edit', function ($trail, $company) use($trans) {
    $trail->parent('companies.index');
    $trail->push($trans('company_edit_link'), route('dashboard.companies.edit', $company));
});
//endregion companies

//region clients
Breadcrumbs::for('company.clients.index', function ($trail, $company) use($trans) {
    $trail->parent('companies.index');
    $trail->push($trans('client_index_link'), route('dashboard.company.clients.index', $company));
});

Breadcrumbs::for('company.clients.show', function ($trail, $company, $client) use($trans) {
    $trail->parent('company.clients.index', $company);
    $trail->push($trans('client_show_link'), route('dashboard.company.clients.show', [$company, $client]));
});

Breadcrumbs::for('company.clients.create', function ($trail, $company) use($trans) {
    $trail->parent('company.clients.index', $company);
    $trail->push($trans('client_create_link'), route('dashboard.company.clients.create', $company));
});

Breadcrumbs::for('company.clients.edit', function ($trail, $company, $client) use($trans) {
    $trail->parent('company.clients.index', $company);
    $trail->push($trans('client_edit_link'), route('dashboard.company.clients.edit', [$company, $client]));
});
//endregion clients

//region client-wallet
Breadcrumbs::for('client.wallet.edit', function ($trail, $company, $client) use($trans) {
    $trail->parent('company.clients.show', $company, $client);
    $trail->push($trans('client_wallet_link'), route('dashboard.client-wallet.edit', $client));
});
Breadcrumbs::for('client.wallet.transactions', function ($trail, $company, $client) use($trans) {
    $trail->parent('company.clients.show', $company, $client);
    $trail->push($trans('client_transactions_link'), route('dashboard.client-wallet.edit', $client));
});
//endregion client-wallet
