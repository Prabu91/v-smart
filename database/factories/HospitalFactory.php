<?php

namespace Database\Factories;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hospital>
 */
class HospitalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Hospital::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'venti' => $this->faker->numberBetween(1, 10)
        ];
    }
}
