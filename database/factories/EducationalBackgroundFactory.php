<?php

namespace Database\Factories;

use App\Models\PersonalDataSheet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EducationalBackground>
 */
class EducationalBackgroundFactory extends Factory
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
            'level' => $this->faker->randomElement(['Elementary','Highschool','College']),
            'school_name' => $this->faker->sentence(),
            'basic_education' => $this->faker->sentence(),
            'scholarship_honor' => $this->faker->sentence(),
            'highest_level' => $this->faker->sentence(),
            'year_graduated' => $this->faker->year(),
            'eb_inclusive_dates_from' => $this->faker->date('Y-m-d'),
            'eb_inclusive_dates_to' => $this->faker->date('Y-m-d'),
        ];
    }
}
