<?php

namespace Modules\Dashboard\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class ClientPolicy
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

    public function view(User $user, Client $client): bool
    {
        return $client->company->compareUserId($user->getKey());
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Client $client): bool
    {
        return $client->company->compareUserId($user->getKey());
    }

    public function delete(User $user, Client $client): bool
    {
        return $client->company->compareUserId($user->getKey());
    }

    public function restore(User $user, Client $client): bool
    {
        return true;
    }

    public function forceDelete(User $user, Client $client): bool
    {
        return true;
    }
}
