<?php

namespace Modules\Dashboard\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class PermissionPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if($user->hasRole('administrator')){
            return true;
        }
    }

    public function viewAny(User $user): bool
    {
        return $user->isAbleTo('permissions-read');
    }

    public function view(User $user, Permission $permission): bool
    {
        return $user->isAbleTo('permissions-read');
    }

    public function create(User $user): bool
    {
        return $user->isAbleTo('permissions-create');
    }

    public function update(User $user, Permission $permission): bool
    {
        return $user->isAbleTo('permissions-update');
    }

    public function delete(User $user, Permission $permission): bool
    {
        return $user->isAbleTo('permissions-delete');
    }

    public function restore(User $user, Permission $permission): bool
    {
        return false;
    }

    public function forceDelete(User $user, Permission $permission): bool
    {
        return false;
    }
}
