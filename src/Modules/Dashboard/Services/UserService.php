<?php

namespace Modules\Dashboard\Services;


use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class UserService extends BaseService
{
    public function paginate(): LengthAwarePaginator
    {
        return User::with('roles')->paginate();
    }

    public function create(array $data): User
    {
        $user = User::create($data);
        $user->roles()->sync($data['roles'] ?? []);
        return $user;
    }

    public function update(User $user, array $data): User
    {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email']
        ]);

        $user->roles()->sync($data['roles'] ?? []);

        if(!empty($data['password'])){
            $user->update(['password' => $data['password']]);
        }

        return $user;
    }
}
