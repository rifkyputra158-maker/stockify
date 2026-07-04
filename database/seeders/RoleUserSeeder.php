<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['name' => 'Admin', 'email' => 'admin@stockify.test', 'password' => bcrypt('password'), 'role' => 'admin']);
    User::create(['name' => 'Manajer Gudang', 'email' => 'manajer@stockify.test', 'password' => bcrypt('password'), 'role' => 'manajer_gudang']);
    User::create(['name' => 'Staff Gudang', 'email' => 'staff@stockify.test', 'password' => bcrypt('password'), 'role' => 'staff_gudang']);
    }
}
