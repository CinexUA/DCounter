<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Modules\Dashboard\Http\Requests\RoleRequest;
use Modules\Dashboard\Services\RoleService;

class RolesController extends BaseController
{
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->authorizeResource(Role::class);
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = $this->roleService->paginate();
        return view('dashboard::roles.index', compact('roles'));
    }

    public function show(Role $role)
    {
        return view('dashboard::roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::pluck('display_name', 'id')->toArray();
        $selectedPermissions = $role->permissions()->pluck('id')->toArray();
        return view('dashboard::roles.edit', compact('role', 'permissions', 'selectedPermissions'));
    }

    public function update(RoleRequest $roleRequest, Role $role)
    {
        toastr()->success(__("Roles permissions has been updated"));
        $this->roleService->update($role, $roleRequest->validated());
        return redirect()->back();
    }
}
