<?php

namespace Database\Seeders;

use App\Models\UserDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserDetail::create([
            'hospital' => 'KC Soreang',
            'venti' => 7,
            'bed' => 10
        ]);

        UserDetail::create([
            'hospital' => 'RS Hermina',
            'venti' => 5, 
            'bed' => 10
        ]);

        UserDetail::create([
            'hospital' => 'RSUD Otista',
            'venti' => 6,
            'bed' => 10
        ]);

        UserDetail::create([
            'hospital' => 'RSU Bina Sehat',
            'venti' => 4,
            'bed' => 10
        ]);    
    }
}
