<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\User;
use Modules\Dashboard\Http\Requests\UserProfileRequest;
use Modules\Dashboard\Services\UserService;

class ProfileController extends BaseController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function edit(User $profile)
    {
        return view('dashboard::profile.edit', ['user' => $profile]);
    }

    public function update(UserProfileRequest $userProfileRequest, User $profile)
    {
        toastr()->success(__("User profile updated"));
        $this->userService->update($profile, $userProfileRequest->validated());

        return redirect()->back();
    }

}
