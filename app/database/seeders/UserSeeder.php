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
        $bayu = new User();
        $bayu->id = 1;
        $bayu->nama = 'Ananda Bayu';
        $bayu->email = 'bayu@gmail.com';
        $bayu->npp = '12345';
        $bayu->npp_supervisor = '11111';
        $bayu->password = bcrypt('12345');
        $bayu->save();

        $spv = new User();
        $spv->id = 2;
        $spv->nama = 'Supervisor';
        $spv->email = 'spv@gmail.com';
        $spv->npp = '11111';
        $spv->npp_supervisor = null;
        $spv->password = bcrypt('12345');
        $spv->save();
    }
}
