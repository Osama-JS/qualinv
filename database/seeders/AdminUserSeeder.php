<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@qualityinvestment.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create editor user
        User::create([
            'name' => 'Editor User',
            'email' => 'editor@qualityinvestment.com',
            'password' => Hash::make('password123'),
            'role' => 'editor',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create viewer user
        User::create([
            'name' => 'Viewer User',
            'email' => 'viewer@qualityinvestment.com',
            'password' => Hash::make('password123'),
            'role' => 'viewer',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
    }
}
