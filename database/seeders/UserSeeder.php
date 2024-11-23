<?php

namespace Database\Seeders;

use App\Models\UserDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminHospital = UserDetail::firstWhere('hospital', 'KC Soreang');
        
        User::create([
            'name' => 'Admin',
            'email' => 'admin@vsmart.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'user_detail_id' => $adminHospital->id,
        ]);

        // Menambah 3 user dengan nama sesuai dengan nama rumah sakit
        $hospitals = UserDetail::whereIn('hospital', ['RS Hermina', 'RSUD Otista', 'RSU Bina Sehat'])->get();

        foreach ($hospitals as $hospital) {
            User::factory()->create([
                'name' => $hospital->hospital,
                'email' => strtolower(str_replace(' ', '.', $hospital->hospital)) . '@vsmart.com',
                'role' => 'user',
                'user_detail_id' => $hospital->id,
            ]);
        }
    }
}

