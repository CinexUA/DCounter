<?php

namespace Modules\Dashboard\Services;


use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


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

        if(isset($data['avatar'])){
            $this->avatarUpload($user, $data['avatar']);
        }

        if(!empty($data['password'])){
            $user->update(['password' => $data['password']]);
        }

        return $user;
    }

    public function avatarUpload(User $user, UploadedFile $avatar)
    {
        $user->addMediaFromString($this->compressImage($avatar))
            ->sanitizingFileName(function($fileName) {
                $name = md5(Str::uuid());
                return $name.'.jpg';
            })
            ->toMediaCollection('avatar');
    }

    public function compressImage(UploadedFile $avatar)
    {
        return Image::make($avatar)
            ->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->stream('jpg', 75);
    }
}
