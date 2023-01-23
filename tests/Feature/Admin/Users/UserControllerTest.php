<?php

namespace Tests\Feature\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Tests\Traits\AdminUserTrait;

class UserControllerTest extends TestCase
{
    use AdminUserTrait;
    use RefreshDatabase;
    private User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminUser = $this->createUser();
    }

    public function test_not_can_view_list_user_page_if_not_authenticated()
    {
        $response = $this->get(route('admin.users.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_list_user_page_all_users()
    {
        $response = $this->actingAs($this->adminUser)->get(route('admin.users.index'));
        $response->assertStatus(200);
    }

    public function test_can_edit_user()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test_user@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole(Role::create(['name' => 'user'])->name);
        $data = [
            'name' => 'Test User Updated',
            'email' => $user->email,
            'role' => $user->roles->first()->id,
        ];
        $response = $this->actingAs($this->adminUser)->put(route('admin.users.update', $user->id), $data);
        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'name' => 'Test User Updated',
        ]);
    }

    public function test_can_delete_user()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test_user@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole(Role::create(['name' => 'user'])->name);
        $response = $this->actingAs($this->adminUser)->delete(route('admin.users.destroy', $user->id));
        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseMissing('users', [
            'name' => 'Test User',
        ]);
    }
}
