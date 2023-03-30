<?php

namespace Database\Factories;

use App\Models\PersonalDataSheet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TrainingProgramsAttendedFactory extends Factory
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
            'program_title' => $this->faker->text(1),
            'hours' => $this->faker->number(),
            'type' => $this->faker->text(1),
            'conducted_by' => $this->faker->name(),
            'tp_inclusive_dates_from' => $this->faker->date(),
            'tp_inclusive_dates_to' => $this->faker->date()
        ];
    }
}
