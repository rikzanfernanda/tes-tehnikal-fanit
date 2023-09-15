<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\PresenceSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApproveTest extends TestCase
{
    use RefreshDatabase;

    public function test_approve_unauthorized()
    {
        $res = $this->post(route('presence.approve'), [
            'id_presences' => 1,
            'is_approve' => 1
        ]);

        $res->assertStatus(401);

        $res->assertJson([
            'message' => 'Unauthorized'
        ]);
    }

    public function test_approve_cannot_perform()
    {
        $this->seed([UserSeeder::class, PresenceSeeder::class]);

        $res_login = $this->post(route('auth.login'), [
            'email' => 'bayu@gmail.com',
            'password' => '12345'
        ]);

        $token = $res_login->json()['data']['authorization']['token'];

        $res = $this->post(route('presence.approve'), [
            'id_presences' => 1,
            'is_approve' => 0
        ], [
            'Authorization' => 'Bearer ' . $token
        ]);

        $res->assertStatus(401);

        $res->assertJson([
            'message' => 'You cannot perform this action'
        ]);
    }

    public function test_approve_cannot_perform_by_supervisor()
    {
        $this->seed([UserSeeder::class]);

        $user = new User();
        $user->id = 100;
        $user->nama = 'Tes User';
        $user->email = 'tes@gmail.com';
        $user->npp = '99999';
        $user->npp_supervisor = '88888';
        $user->password = bcrypt('12345');
        $user->save();

        $res_login = $this->post(route('auth.login'), [
            'email' => 'tes@gmail.com',
            'password' => '12345'
        ]);

        $token = $res_login->json()['data']['authorization']['token'];

        $res = $this->post(route('presence.create'), [
            'type' => 'IN',
            'waktu' => '2023-09-12 08:00:00'
        ], [
            'Authorization' => 'Bearer ' . $token
        ])->json();

        $res_login_supervisor = $this->post(route('auth.login'), [
            'email' => 'spv@gmail.com',
            'password' => '12345'
        ])->json();

        $token_spv = $res_login_supervisor['data']['authorization']['token'];

        $res_approve = $this->post(route('presence.approve'), [
            'id_presences' => $res['data']['id'],
            'is_approve' => 1
        ], [
            'Authorization' => 'Bearer ' . $token_spv
        ]);

        $res_approve->assertStatus(401);

        $res_approve->assertJson([
            'message' => 'You cannot perform this action'
        ]);
    }

    public function test_approve_success()
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
        ])->json();

        $res_login_supervisor = $this->post(route('auth.login'), [
            'email' => 'spv@gmail.com',
            'password' => '12345'
        ])->json();

        $token_spv = $res_login_supervisor['data']['authorization']['token'];

        $res_approve = $this->post(route('presence.approve'), [
            'id_presences' => $res['data']['id'],
            'is_approve' => 1
        ], [
            'Authorization' => 'Bearer ' . $token_spv
        ]);

        $res_approve->assertStatus(200);

        $res_approve->assertJson([
            'message' => 'Presence successfully updated'
        ]);
    }
}
