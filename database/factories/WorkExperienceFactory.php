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
            'position_title' => $this->faker->text(1),
            'department' => $this->faker->text(1),
            'monthly_salary' => $this->faker->number(1),
            'salary' => $this->faker->number(1),
            'status_appointment' => $this->faker->text(1),
            'government_service' => $this->faker->text(1),
            'inclusive_dates_from' => $this->faker->date(),
            'inclusive_dates_to' => $this->faker->date(),
        ];
    }
}
