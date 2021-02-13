<?php

namespace Modules\Dashboard\Services;


use App\Models\Role;


class RoleService extends BaseService
{
    public function listAsSelectArray()
    {
        return Role::all()->pluck('name', 'id')->toArray();
    }
}
