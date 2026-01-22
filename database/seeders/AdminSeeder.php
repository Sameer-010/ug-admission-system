<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@ug.edu.pk',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        // Create Staff
        User::create([
            'name' => 'Staff Member',
            'email' => 'staff@ug.edu.pk',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'email_verified_at' => now()
        ]);

        // Create Test Student
        User::create([
            'name' => 'Test Student',
            'email' => 'student@ug.edu.pk',
            'password' => Hash::make('password'),
            'role' => 'student',
            'phone' => '03001234567',
            'email_verified_at' => now()
        ]);
    }
}