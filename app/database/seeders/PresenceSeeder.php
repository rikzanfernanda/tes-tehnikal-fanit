<?php

namespace Database\Seeders;

use App\Models\Presence;
use Illuminate\Database\Seeder;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Presence::create([
            'id_users' => 1,
            'type' => 'IN',
            'is_approve' => 'true',
            'waktu' => '2023-09-14 08:00:00'
        ]);

        Presence::create([
            'id_users' => 1,
            'type' => 'OUT',
            'is_approve' => 'false',
            'waktu' => '2023-09-14 16:00:00'
        ]);
    }
}
