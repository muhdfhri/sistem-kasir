<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    protected $signature = 'make:admin';
    protected $description = 'Membuat akun admin default';

    public function handle()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@sistemkasir.com',
            'password' => Hash::make('12345'),
            'role' => 'admin',
        ]);

        $this->info("Admin berhasil dibuat!");
        $this->line("Email: admin@sistemkasir.com");
        $this->line("Password: 12345");
    }
}