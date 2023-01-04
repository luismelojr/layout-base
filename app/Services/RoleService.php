<?php

namespace App\Services;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function __construct(
        private \Spatie\Permission\Models\Role $role
    ){}

    public function getAll(Request $request)
    {
        $roles = $this->role->query()
            ->when($request->name, fn($query, $name) => $query->where('name', 'like', "%{$name}%"));

        return [
            'roles' => $roles->paginate(10)->withQueryString(),
            'filters' => $request->query(),
        ];
    }

    public function getAllPermissions()
    {
        $permissions = \Spatie\Permission\Models\Permission::query()->select(['id', 'name'])->get();
        $info = [];
        foreach ($permissions as $permission) {
            $model = explode('-', $permission->name)[1];
            if ($info[$model] ?? false) {
                $info[$model][] = [
                    'id' => $permission->id,
                    'name' => $permission->name,
                ];
            } else {
                $info[$model] = [[
                    'id' => $permission->id,
                    'name' => $permission->name,
                ]];
            }
        }
        return $info;
    }

    public function create(Request $request)
    {
        $role = $this->role->create([
            'name' => $request->name,
        ]);
        $role->syncPermissions($request->permissions);
        return $role;
    }

    public function update(Request $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $role->syncPermissions($request->permissions);
        return $role;
    }

    public function delete(Role $role)
    {
        $role->delete();
    }
}
