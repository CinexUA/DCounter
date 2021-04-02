<?php

namespace Modules\Dashboard\Services;


use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class RoleService extends BaseService
{
    public function listAsSelectArray()
    {
        return Role::pluck('name', 'id')->toArray();
    }

    public function paginate(): LengthAwarePaginator
    {
        return Role::paginate();
    }

    public function update(Role $role, array $data): Role
    {
        $role->syncPermissions($data['permissions'] ?? []);
        return $role;
    }
}
