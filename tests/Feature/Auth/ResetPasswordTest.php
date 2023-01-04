<?php

namespace Tests\Feature\Auth;

use App\Models\Password;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_reset_password_screen_can_be_rendered()
    {
        $password = Password::create([
            'email' => 'junimhs10@gmail.com',
            'token' => '1234567890',
            'expired_at' => now()->addMinutes(10)
        ]);

        $response = $this->get("/password-reset?token={$password->token}");

        $response->assertStatus(200);
    }

    public function test_reset_password_screen_cannot_be_rendered()
    {
        $response = $this->get("/password-reset?token=1234567890");

        $response->assertRedirect(route('password.request'));
    }

    public function test_password_can_be_reset_with_valid_token()
    {
        $user = User::factory()->create([
            'email' => 'teste@gmail.com',
            'name' => 'Teste',
            'password' => bcrypt('12345678')
        ]);

        $password = Password::create([
            'email' => $user->email,
            'token' => '1234567890',
            'expired_at' => now()->addMinutes(10)
        ]);

        $response = $this->post("/password-reset", [
            'token' => $password->token,
            'email' => $user->email,
            'password' => '123456789',
            'password_confirmation' => '123456789'
        ]);

        $response->assertRedirect(route('login'));
    }
}
