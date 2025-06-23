<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
            'is_admin' => true, // sesuaikan jika kamu pakai role atau level
        ]);
    }
}
