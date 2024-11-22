<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminHospital = Hospital::firstWhere('name', 'KC Soreang');
        
        User::create([
            'name' => 'Admin',
            'email' => 'admin@vsmart.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'hospital_id' => $adminHospital->id,
        ]);

        // Menambah 3 user dengan nama sesuai dengan nama rumah sakit
        $hospitals = Hospital::whereIn('name', ['RS Hermina', 'RSUD Otista', 'RSU Bina Sehat'])->get();

        foreach ($hospitals as $hospital) {
            User::factory()->create([
                'name' => $hospital->name,
                'email' => strtolower(str_replace(' ', '.', $hospital->name)) . '@vsmart.com',
                'role' => 'user',
                'hospital_id' => $hospital->id,
            ]);
        }
    }
}

