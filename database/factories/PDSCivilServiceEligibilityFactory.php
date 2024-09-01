<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CivilServiceEligibility>
 */
class PDSCivilServiceEligibilityFactory extends Factory
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
            'eligibility_title' => $this->faker->sentence(),
            'rating' => $this->faker->numberBetween(75,99),
            'date_of_examination_conferment' => $this->faker->date('Y-m-d'),
            'place_of_examination_conferment' => $this->faker->address(),
            'license_number' => $this->faker->randomNumber(),
            'license_date_validity' => $this->faker->date('Y-m-d'),
        ];
    }
}
