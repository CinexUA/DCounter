<?php

namespace Modules\Dashboard\Services;


use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class RoleService extends BaseService
{
    public function listAsSelectArray()
    {
        return Role::all()->pluck('name', 'id')->toArray();
    }

    public function paginate(): LengthAwarePaginator
    {
        return Role::paginate();
    }
}
