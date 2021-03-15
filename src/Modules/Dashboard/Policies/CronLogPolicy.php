<?php

namespace Modules\Dashboard\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class CronLogPolicy
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
        return $user->isAbleTo('cron-logs-read');
    }

    public function view(User $user, Role $role): bool
    {
        return $user->isAbleTo('cron-logs-read');
    }
}
