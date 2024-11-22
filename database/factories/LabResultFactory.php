<?php

namespace Database\Factories;

use App\Models\LabResult;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LabResult>
 */
class LabResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = LabResult::class;

    public function definition()
    {
        return [
            'patient_id' => Patient::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'hb' => $this->faker->randomFloat(2, 10, 16), // Hemoglobin
            'leukosit' => $this->faker->randomFloat(2, 4, 12), // Leukosit
            'pcv' => $this->faker->randomFloat(2, 30, 50), // PCV
            'trombosit' => $this->faker->randomNumber(5), // Trombosit
            'kreatinin' => $this->faker->randomFloat(2, 0.5, 2), // Kreatinin
        ];
    }
}
