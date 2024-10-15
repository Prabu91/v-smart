<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com', // Ganti dengan email admin yang diinginkan
            'password' => Hash::make('password'), // Ganti dengan password yang diinginkan
            'role' => 'admin', // Ganti dengan email admin yang diinginkan
        ]);
    }
}

