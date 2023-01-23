<?php

namespace Tests\Traits;

use App\Models\User;
use Spatie\Permission\Models\Role;

trait AdminUserTrait
{
    public function createUser()
    {
        $user = User::create([
            'name' => 'Test Admin',
            'email' => 'test_admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($this->createRoleAndPermissionsAdmin()->name);
        return $user;
    }

    public function createUserWithRoleUser()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test_user@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole(Role::create(['name' => 'user'])->name);
        return $user;
    }

    private function createRoleAndPermissionsAdmin()
    {
        $role = Role::create(['name' => 'admin']);
        foreach (['create', 'read', 'update', 'delete'] as $action) {
            foreach (['users', 'roles'] as $resource) {
                \Spatie\Permission\Models\Permission::create([
                    'name' => $action . '-' . $resource,
                ])->assignRole($role->name);
            }
        }

        return $role;
    }
}
