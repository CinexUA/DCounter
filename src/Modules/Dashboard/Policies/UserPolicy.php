<?php

namespace Modules\Dashboard\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $currentUser, string $ability)
    {
        if($ability !== 'delete' && $currentUser->hasRole('administrator')){
            return true;
        }
    }

    public function viewAny(User $currentUser): bool
    {
        return $currentUser->isAbleTo('users-read');
    }

    public function view(User $currentUser, User $user): bool
    {
        return $currentUser->isAbleTo('users-read');
    }

    public function create(User $currentUser): bool
    {
        return $currentUser->isAbleTo('users-create');
    }

    public function update(User $currentUser, User $user): bool
    {
        return $currentUser->isAbleTo('users-update');
    }

    public function delete(User $currentUser, User $user): bool
    {
        if($currentUser->isAbleTo('users-delete')){
            return ($currentUser->getKey() !== $user->getKey());
        }
        return false;
    }

    public function restore(User $currentUser, User $user): bool
    {
        return true;
    }

    public function forceDelete(User $currentUser, User $user): bool
    {
        return true;
    }
}
