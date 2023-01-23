<?php

namespace Tests\Feature\Admin\Roles;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Tests\Traits\AdminUserTrait;

class RoleControllerTest extends TestCase
{
    use AdminUserTrait;
    use RefreshDatabase;
    private User $adminUser;
    private Permission $permission;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminUser = $this->createUser();
        $this->permission = Permission::create(['name' => 'create roles']);
    }

    public function test_not_can_view_list_roles_page_if_not_authenticated()
    {
        $response = $this->get(route('admin.settings.roles.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_not_can_view_list_roles_page_if_permissions()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test_user@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole(Role::create(['name' => 'user'])->name);
        $response = $this->actingAs($user)->get(route('admin.settings.roles.create'));
        $response->assertStatus(403);
    }

    public function test_not_can_create_role_without_select_permissions()
    {
        $response = $this->actingAs($this->adminUser)->post(route('admin.settings.roles.store'), [
            'name' => 'Test Role',
            'permissions' => [],
        ]);

        $response->assertRedirect(route('admin.settings.roles.create'));
    }

    public function test_create_role_success()
    {
        $response = $this->actingAs($this->adminUser)->post(route('admin.settings.roles.store'), [
            'name' => 'Test Role',
            'permissions' => [$this->permission->id],
        ]);

        $response->assertRedirect(route('admin.settings.roles.index'));
        $this->assertDatabaseHas('roles', [
            'name' => 'Test Role',
        ]);
    }

    public function test_not_can_create_role_if_exists_name()
    {
        $response = $this->actingAs($this->adminUser)->post(route('admin.settings.roles.store'), [
            'name' => 'Test Role',
            'permissions' => [$this->permission->id],
        ]);

        $response_exist = $this->actingAs($this->adminUser)->post(route('admin.settings.roles.store'), [
            'name' => 'Test Role',
            'permissions' => [$this->permission->id],
        ]);

        $response_exist->assertSessionHasErrors('name');
    }

    public function test_can_edit_role_success()
    {
        $role = Role::create(['name' => 'Test Role']);
        $response = $this->actingAs($this->adminUser)->put(route('admin.settings.roles.update', $role->id), [
            'name' => 'Test Role Edit',
            'permissions' => [$this->permission->id],
        ]);

        $response->assertRedirect(route('admin.settings.roles.edit', $role->id));
        $this->assertDatabaseHas('roles', [
            'name' => 'Test Role Edit',
        ]);
    }

    public function test_can_delete_role_success()
    {
        $role = Role::create(['name' => 'Test Role']);
        $response = $this->actingAs($this->adminUser)->delete(route('admin.settings.roles.destroy', $role->id));
        $response->assertRedirect(route('admin.settings.roles.index'));
        $this->assertDatabaseMissing('roles', [
            'name' => 'Test Role',
        ]);
    }
}
