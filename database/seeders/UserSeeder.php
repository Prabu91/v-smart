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
        // Menambah Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com', 
            'password' => Hash::make('password'),
            'role' => 'admin', 
            'hospital' => 'KC Soreang', 
        ]);
        
        // Menambah 3 user menggunakan factory
        User::factory()->count(1)->create([
            'name' => 'RS Hermina',
            'email' => 'hermina@gmail.com', 
            'hospital' => 'RS Hermina',
            'role' => 'user',
        ]);
        
        User::factory()->count(1)->create([
            'name' => 'RSUD Otista',
            'email' => 'otista@gmail.com',
            'hospital' => 'RSUD Otista',
            'role' => 'user',
        ]);
        
        User::factory()->count(1)->create([
            'name' => 'RSU Bina Sehat',
            'email' => 'bina.sehat@gmail.com',
            'hospital' => 'RSU Bina Sehat',
            'role' => 'user',
        ]);
    }
}

