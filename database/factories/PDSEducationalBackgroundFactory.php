<?php

namespace Database\Factories;

use App\Models\PersonalDataSheet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EducationalBackground>
 */
class PDSEducationalBackgroundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $personal_data_sheets = PersonalDataSheet::all();

        return [
            'personal_data_sheet_id' => $personal_data_sheets->random()->id,
            'level' => $this->faker->randomElement(['Elementary', 'Highschool', 'College']),
            'school_name' => $this->faker->sentence(),
            'degree' => $this->faker->sentence(),
            'period_to' => date("Y")-1,
            'period_from' => date("Y"),
            'highest_unit_earned' => $this->faker->sentence(),
            'year_graduated' => $this->faker->year(),
            'scholarship_academic_awards' => $this->faker->sentence(),
        ];
    }
}
