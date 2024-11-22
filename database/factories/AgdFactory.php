<?php

namespace Database\Factories;
use App\Models\Agd;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agd>
 */
class AgdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Agd::class;

    public function definition()
    {
        return [
            'patient_id' => Patient::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'ph' => $this->faker->randomFloat(2, 7.2, 7.4),
            'pco2' => $this->faker->randomFloat(2, 30, 40),
            'po2' => $this->faker->randomFloat(2, 70, 100),
            'spo2' => $this->faker->randomFloat(2, 90, 100),
        ];
    }
}
