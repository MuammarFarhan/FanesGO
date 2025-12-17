<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    protected $signature = 'make:admin';
    protected $description = 'Buat akun admin FANES.GO';

    public function handle()
    {
        $email = $this->ask('Email admin');
        $password = $this->secret('Password admin');

        if (User::where('email', $email)->exists()) {
            $this->error('Email sudah terdaftar');
            return;
        }

        User::create([
            'name' => 'Administrator',
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info('Admin berhasil dibuat');
    }
}
