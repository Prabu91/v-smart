<?php

namespace Database\Factories;

use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = UserDetail::class;

    public function definition(): array
    {
        return [
            'hospital' => $this->faker->company(),
            'venti' => $this->faker->numberBetween(1, 10),
            'bed' => $this->faker->numberBetween(1, 10)
        ];
    }
}
