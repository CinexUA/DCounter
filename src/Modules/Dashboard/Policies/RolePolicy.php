<?php

namespace Modules\Dashboard\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class RolePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if($user->hasRole('superadministrator')){
            return true;
        }
    }

    public function viewAny(User $user): bool
    {
        return $user->isAbleTo('roles-read');
    }

    public function view(User $user, Role $role): bool
    {
        return $user->isAbleTo('roles-read');
    }

    public function create(User $user): bool
    {
        return $user->isAbleTo('roles-create');
    }

    public function update(User $user, Role $role): bool
    {
        return $user->isAbleTo('roles-update');
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->isAbleTo('roles-delete');
    }

    public function restore(User $user, Role $role): bool
    {
        return false;
    }

    public function forceDelete(User $user, Role $role): bool
    {
        return false;
    }
}
