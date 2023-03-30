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
        $number = 1;
        return [
            'personal_data_sheet_id' => $number++,
            'career_service' => $this->faker->text(1),
            'rating' => $this->faker->text(1),
            'examination_date' => $this->faker->date(),
            'place_examination' => $this->faker->text(1),
            'license_number' => $this->faker->unique()->number(),
            'date_validity' => $this->faker->date(),
        ];
    }
}
