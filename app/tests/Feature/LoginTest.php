<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_fail()
    {
        $res = $this->post(route('auth.login'), [
            'email' => 'bayu@gmail.com',
            'password' => '12345'
        ]);

        $res->assertStatus(401);
    }

    public function test_login_email_or_password_is_wrong()
    {
        $this->seed([UserSeeder::class]);

        $res = $this->post(route('auth.login'), [
            'email' => 'bayux@gmail.com',
            'password' => '123456'
        ]);

        $res->assertStatus(401);
        $res->assertJson([
            'message' => 'Email or password is incorrect'
        ]);
    }

    public function test_login_success()
    {
        $this->seed([UserSeeder::class]);

        $res = $this->post(route('auth.login'), [
            'email' => 'bayu@gmail.com',
            'password' => '12345'
        ]);

        $res->assertStatus(200);
        $res->assertJson([
            'message' => 'Login successful',
            'data' => [
                'user' => [
                    'email' => 'bayu@gmail.com',
                ]
            ]
        ]);
    }
}
