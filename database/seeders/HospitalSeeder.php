<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hospital::create([
            'name' => 'KC Soreang',
            'venti' => 7,
        ]);

        Hospital::create([
            'name' => 'RS Hermina',
            'venti' => 5, 
        ]);

        Hospital::create([
            'name' => 'RSUD Otista',
            'venti' => 6,
        ]);

        Hospital::create([
            'name' => 'RSU Bina Sehat',
            'venti' => 4,
        ]);    }
}
