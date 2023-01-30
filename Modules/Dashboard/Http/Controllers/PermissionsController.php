<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Modules\Dashboard\Http\Requests\PermissionRequest;
use Modules\Dashboard\Http\Requests\RoleRequest;
use Modules\Dashboard\Services\PermissionService;
use Modules\Dashboard\Services\RoleService;

class PermissionsController extends BaseController
{
    private $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->authorizeResource(Permission::class);
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        $permissions = $this->permissionService->paginate();
        return view('dashboard::permissions.index', compact('permissions'));
    }

    public function show(Permission $permission)
    {
        return view('dashboard::permissions.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        return view('dashboard::permissions.edit', compact('permission'));
    }

    public function update(PermissionRequest $permissionRequest, Permission $permission)
    {
        toastr()->success(__("Permission has been updated"));
        $this->permissionService->update($permission, $permissionRequest->validated());
        return redirect()->back();
    }
}
