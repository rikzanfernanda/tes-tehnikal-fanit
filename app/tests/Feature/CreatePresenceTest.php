<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePresenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_presence_fail()
    {
        $res = $this->post(route('presence.create'), [
            'type' => 'IN',
            'waktu' => '2023-09-12 08:00:00'
        ]);

        $res->assertStatus(401);

        $res->assertJson([
            'message' => 'Unauthorized'
        ]);
    }

    public function test_create_presence_success()
    {
        $this->seed([UserSeeder::class]);

        $res_login = $this->post(route('auth.login'), [
            'email' => 'bayu@gmail.com',
            'password' => '12345'
        ]);

        $token = $res_login->json()['data']['authorization']['token'];

        $res = $this->post(route('presence.create'), [
            'type' => 'IN',
            'waktu' => '2023-09-12 08:00:00'
        ], [
            'Authorization' => 'Bearer ' . $token
        ]);

        $res->assertStatus(201);

        $res->assertJson([
            'message' => 'Presence created successfully'
        ]);
    }
}
