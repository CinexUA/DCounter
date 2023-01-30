<?php

namespace Modules\Dashboard\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class CompanyPolicy
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
        return true;
    }

    public function view(User $user, Company $company): bool
    {
        return $company->compareUserId($user->getKey());
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Company $company): bool
    {
        return $company->compareUserId($user->getKey());
    }

    public function delete(User $user, Company $company): bool
    {
        return $company->compareUserId($user->getKey());
    }

    public function restore(User $user, Company $company): bool
    {
        return true;
    }

    public function forceDelete(User $user, Company $company): bool
    {
        return true;
    }
}
