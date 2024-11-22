<?php

namespace Database\Factories;

use App\Models\OriginRoom;
use App\Models\LabResult;
use App\Models\Agd;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OriginRoom>
 */
class OriginRoomFactory extends Factory
{
    protected $model = OriginRoom::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'origin_room_datetime' => $this->faker->dateTimeThisYear(),
            'origin_room_name' => $this->faker->randomElement(['ICU', 'NICU', 'PICU']),
            'radiology' => $this->faker->word,
            'ro_thorax' => $this->faker->word,
            'additional_check' => $this->faker->sentence,
            'main_diagnose' => $this->faker->word,
            'secondary_diagnose' => $this->faker->word,
            'labresult_id' => LabResult::inRandomOrder()->first()->id,
            'agd_id' => Agd::inRandomOrder()->first()->id,
            'intubation_id' => null, // Intubation kosong
            'patient_id' => Patient::inRandomOrder()->first()->id,
        ];
    }
}
