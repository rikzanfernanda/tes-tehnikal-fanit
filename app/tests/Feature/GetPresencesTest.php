<?php

namespace Tests\Feature;

use Database\Seeders\PresenceSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetPresencesTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_presences_fail()
    {
        $res = $this->get(route('presences.index'));

        $res->assertStatus(401);

        $res->assertJson([
            'message' => 'Unauthorized'
        ]);
    }

    public function test_get_presences_success()
    {
        $this->seed([UserSeeder::class, PresenceSeeder::class]);

        $res_login = $this->post(route('auth.login'), [
            'email' => 'spv@gmail.com',
            'password' => '12345'
        ])->json();

        $res = $this->get(route('presences.index'), [
            'Authorization' => 'bearer ' . $res_login['data']['authorization']['token']
        ]);

        $res->assertStatus(200);

        $res->assertJson([
            'message' => 'Success get data',
            'data' => [
                [
                    'id_user' => 1,
                    'nama_user' => 'Ananda Bayu'
                ]
            ]
        ]);
    }
}
