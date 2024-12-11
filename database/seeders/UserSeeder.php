<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Test User',
            'username' => 'admin',
            'role' => 'admin',
            'password' => 'admin',
        ]);
        User::create([
            'name' => 'Test User',
            'username' => 'employee',
            'role' => 'employee',
            'password' => 'employee',
        ]);
        User::create([
            'name' => 'Test User',
            'username' => 'analyst',
            'role' => 'analyst',
            'password' => 'analyst',
        ]);
        User::factory()->count(50)->create();
    }
}
