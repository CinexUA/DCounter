<?php

namespace Modules\Dashboard\Services;


use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Psr\Http\Message\StreamInterface;


class UserService extends BaseService
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        $perPage = $request->get('per-page');
        return User::with('roles')
            ->filter($request->all())
            ->paginateFilter($perPage);
    }

    public function create(array $data): User
    {
        $user = User::create($data);
        $user->roles()->sync($data['roles'] ?? []);
        return $user;
    }

    public function update(User $user, array $data): User
    {
        $filteredData = Arr::only($data, ['name', 'email']);
        $user->update($filteredData);
        $user->roles()->sync($data['roles'] ?? []);

        if(isset($data['avatar'])){
            $this->avatarUpload($user, $data['avatar']);
        }

        if(!empty($data['password'])){
            $user->update(['password' => $data['password']]);
        }

        return $user;
    }

    public function avatarUpload(User $user, UploadedFile $avatar): void
    {
        $user->addMediaFromString($this->compressImage($avatar))
            ->sanitizingFileName(function($fileName) {
                $name = md5(Str::uuid());
                return $name.'.jpg';
            })
            ->toMediaCollection('avatar');
    }

    public function compressImage(UploadedFile $avatar): StreamInterface
    {
        return Image::make($avatar)
            ->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->stream('jpg', 75);
    }
}
