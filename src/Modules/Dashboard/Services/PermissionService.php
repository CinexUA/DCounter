<?php

namespace Modules\Dashboard\Services;


use App\Models\Permission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class PermissionService extends BaseService
{
    public function paginate(): LengthAwarePaginator
    {
        return Permission::paginate();
    }

    public function update(Permission $permission, array $data): Permission
    {
        $permission->update($data);
        return $permission;
    }
}
