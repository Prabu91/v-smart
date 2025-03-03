<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Patient::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'no_jkn' => $this->faker->numerify('00###########'),
            'no_rm' => $this->faker->numerify('RM######'),
            'no_sep' => $this->faker->numerify('0120R0150225V#######'),
            'gender' => $this->faker->randomElement(['L', 'P']),
            'birth_date' => $this->faker->date('Y-m-d', '-20 years'),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
