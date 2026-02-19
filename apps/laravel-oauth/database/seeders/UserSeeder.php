<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'status' => 'active',
            'role' => 'admin',
            'password' => 'admin',
        ]);
        User::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'status' => 'active',
            'role' => 'staff',
            'password' => 'staff',
        ]);
        User::create([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'status' => 'active',
            'role' => 'customer',
            'password' => 'customer',
        ]);
    }
}
