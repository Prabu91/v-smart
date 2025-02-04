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
            'name' => 'Faris F',
            'username' => 'farisfdlh',
            'password' => Hash::make('4Dm1nInv!'),
            'role' => 'super admin',
            'user_detail_id' => $adminHospital->id,
        ]);

        User::create([
            'name' => 'KC Soreang',
            'username' => 'kcsoreang',
            'password' => Hash::make('@Kcs385a!'),
            'role' => 'admin',
            'user_detail_id' => $adminHospital->id,
        ]);

        // Menambah 3 user dengan nama sesuai dengan nama rumah sakit
        $hospitals = UserDetail::whereIn('hospital', ['RS Hermina', 'RSUD Otista', 'RS AMC'])->get();

        foreach ($hospitals as $hospital) {
            User::factory()->create([
                'name' => $hospital->hospital,
                'username' => strtolower(str_replace(' ', '.', $hospital->hospital)),
                'role' => 'user',
                'user_detail_id' => $hospital->id,
            ]);
        }
    }
}

