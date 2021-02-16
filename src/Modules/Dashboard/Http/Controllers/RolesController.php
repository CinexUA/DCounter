<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\Role;
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


}
