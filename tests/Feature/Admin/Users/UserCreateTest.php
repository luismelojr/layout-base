<?php

namespace Tests\Feature\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Tests\Traits\AdminUserTrait;

class UserCreateTest extends TestCase
{
    use AdminUserTrait;
    use RefreshDatabase;
    private User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminUser = $this->createUser();
    }

    public function test_not_can_view_create_user_page_if_not_authenticated()
    {
        $response = $this->get(route('admin.users.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_not_can_view_create_user_page_if_permissions()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test_user@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole(Role::create(['name' => 'user'])->name);
        $response = $this->actingAs($user)->get(route('admin.users.create'));
        $response->assertStatus(403);
    }

    public function test_create_user_success()
    {
        $response = $this->actingAs($this->adminUser)->post(route('admin.users.store'), [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => Role::create(['name' => 'user'])->id,
        ]);
        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@gmail.com'
        ]);
    }

    public function test_not_can_create_user_if_exists_email()
    {
        $response = $this->actingAs($this->adminUser)->post(route('admin.users.store'), [
            'name' => 'Test User',
            'email' => $this->adminUser->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => Role::create(['name' => 'user'])->id,
        ]);
        $response->assertSessionHasErrors('email');
    }

    public function test_not_create_user_if_not_password_confirmation()
    {
        $response = $this->actingAs($this->adminUser)->post(route('admin.users.store'), [
            'name' => 'Test User',
            'email' => 'teste@gmail.com',
            'password' => 'password',
            'role' => Role::create(['name' => 'user'])->id,
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_not_create_user_if_not_role()
    {
        $response = $this->actingAs($this->adminUser)->post(route('admin.users.store'), [
            'name' => 'Test User',
            'email' => 'teste@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors('role');
    }
}
