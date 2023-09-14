<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Ananda Bayu',
            'email' => 'bayu@gmail.com',
            'npp' => '12345',
            'npp_supervisor' => '11111',
            'password' => bcrypt('12345')
        ]);

        User::create([
            'nama' => 'Supervisor',
            'email' => 'spv@gmail.com',
            'npp' => '11111',
            'npp_supervisor' => null,
            'password' => bcrypt('12345')
        ]);
    }
}
