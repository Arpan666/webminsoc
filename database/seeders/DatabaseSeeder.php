<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Default
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'), // Password default
            'role' => 'admin',
        ]);

        // Jika ingin membuat user biasa:
        // User::create([
        //     'name' => 'User Biasa',
        //     'email' => 'user@test.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'user',
        // ]);
    }
}
