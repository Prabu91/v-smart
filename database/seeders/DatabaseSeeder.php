<?php

namespace Database\Seeders;

use App\Models\Hospital;
use App\Models\User;
use App\Models\UserDetail;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserDetailSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PatientSeeder::class);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
