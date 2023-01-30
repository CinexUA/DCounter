<?php

namespace Modules\Dashboard\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class CurrencyPolicy
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
        return $user->isAbleTo('currencies-read');
    }

    public function view(User $user, Role $role): bool
    {
        return $user->isAbleTo('currencies-read');
    }

    public function create(User $user): bool
    {
        return $user->isAbleTo('currencies-create');
    }

    public function update(User $user, Role $role): bool
    {
        return $user->isAbleTo('currencies-update');
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->isAbleTo('currencies-delete');
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
