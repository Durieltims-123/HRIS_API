<?php

namespace Database\Factories;

use App\Models\PersonalDataSheet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkExperience>
 */
class WorkExperienceFactory extends Factory
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
            'position_title' => $this->faker->sentence(),
            'office_company' => $this->faker->sentence(),
            'monthly_salary' => $this->faker->randomNumber(),
            'salary_grade' => $this->faker->randomNumber(),
            'status_of_appointment' => $this->faker->sentence(),
            'government_service' => $this->faker->sentence(),
            'date_from' => $this->faker->date('Y-m-d'),
            'date_to' => $this->faker->date('Y-m-d')
        ];
    }
}
