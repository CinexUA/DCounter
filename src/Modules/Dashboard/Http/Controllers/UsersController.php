<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Modules\Dashboard\Http\Requests\UserRequest;
use Modules\Dashboard\Services\RoleService;
use Modules\Dashboard\Services\UserService;


class UsersController  extends BaseController
{
    private $userService;
    private $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->authorizeResource(User::class);
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function index()
    {
        $users = $this->userService->paginate();
        return view('dashboard::users.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->roleService->listAsSelectArray();
        return view('dashboard::users.create', compact('roles'));
    }


    public function store(UserRequest $userRequest)
    {
        toastr()->success(__("User created"));
        $this->userService->create($userRequest->validated());

        return redirect()->route('dashboard.admin.users.index');
    }


    public function show(User $user)
    {
        return view('dashboard::users.show', compact('user'));
    }


    public function edit(User $user)
    {
        $roles = $this->roleService->listAsSelectArray();
        return view('dashboard::users.edit', compact('user', 'roles'));
    }


    public function update(UserRequest $userRequest, User $user)
    {
        toastr()->success(__("User has been updated"));
        $this->userService->update($user, $userRequest->validated());

        return redirect()->back();
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        toastr()->success(__("User has been deleted"));
        $user->delete();
        return response()->json(['message' => null, 'success' => true], 204);
    }
}
