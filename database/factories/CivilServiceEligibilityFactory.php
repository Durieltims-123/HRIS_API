<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CivilServiceEligibility>
 */
class CivilServiceEligibilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $number = 1;
        return [
            'personal_data_sheet_id' => $number++,
            'career_service' => $this->faker->sentence(),
            'rating' => $this->faker->randomDigit(),
            'examination_date' => $this->faker->date('Y-m-d'),
            'place_examination' => $this->faker->address(),
            'license_number' => $this->faker->randomNumber(),
            'date_validity' => $this->faker->date('Y-m-d'),
        ];
    }
}
