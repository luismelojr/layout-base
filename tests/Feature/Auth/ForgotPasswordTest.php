<?php

namespace Tests\Feature\Auth;

use App\Events\SendMailForgotPasswordEvent;
use App\Models\Password;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;


    public function test_forgot_password_screen_can_be_rendered()
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    public function test_forgot_password_sending_without_email()
    {
        $response = $this->post('/forgot-password', [
            'email' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    public function test_forgot_password_sending_with_email_valid()
    {
        Event::fake();

        User::factory()->create([
            'email' => 'junimhs10@gmail.com'
        ]);

        $response = $this->post('/forgot-password', [
            'email' => 'junimhs10@gmail.com',
        ]);

        $this->assertCount(1, Password::all());
        $response->assertStatus(302);
        Event::assertDispatched(SendMailForgotPasswordEvent::class);
    }

    public function test_forgot_password_sending_with_not_register_user()
    {
        Event::fake();

        $response = $this->post('/forgot-password', [
            'email' => 'junimhs10@gmail.com',
        ]);

        $this->assertCount(0, Password::all());
        $response->assertStatus(302);
        Event::assertNotDispatched(SendMailForgotPasswordEvent::class);
    }
}
