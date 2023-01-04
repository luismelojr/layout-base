<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct(
        private RoleService $roleService
    ){}

    public function index(Request $request)
    {
        $this->authorize('read-roles');
        $info = $this->roleService->getAll($request);
        return Inertia::render('Admin/Settings/Role/Index', [
            'roles' => $info['roles'],
            'filters' => $info['filters'],
        ]);
    }

    public function create()
    {
        $this->authorize('create-roles');
        $permissions = $this->roleService->getAllPermissions();
        return Inertia::render('Admin/Settings/Role/Create', [
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create-roles');
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        if (!$request->permissions) {
            return redirect()->back()->toast('Por favor selecione ao menos uma permissão', 'error');
        }

        $this->roleService->create($request);
        return redirect()->route('admin.settings.roles.index')->toast('Cargo criado com sucesso', 'success');
    }

    public function edit(Role $role)
    {
        $this->authorize('update-roles');
        $permissions = $this->roleService->getAllPermissions();
        return Inertia::render('Admin/Settings/Role/Edit', [
            'role' => $role->load('permissions'),
            'permissions' => $permissions,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('update-roles');
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        if (!$request->permissions) {
            return redirect()->back()->toast('Por favor selecione ao menos uma permissão', 'error');
        }

        $this->roleService->update($request, $role);
        return redirect()->back()->toast('Cargo atualizado com sucesso', 'success');
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete-roles');
        $this->roleService->delete($role);
        return redirect()->back()->toast('Cargo excluído com sucesso', 'success');
    }
}
