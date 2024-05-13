<?php

namespace Database\Factories;

use App\Models\PersonalDataSheet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TrainingProgramAttendedFactory extends Factory
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
            'training_title' => $this->faker->sentence(),
            'attendance_from' => $this->faker->date('Y-m-d'),
            'attendance_to' => $this->faker->date('Y-m-d'),
            'number_of_hours' => $this->faker->numberBetween(1,255),
            'training_type' => $this->faker->word(),
            'conducted_sponsored_by' => $this->faker->name()



        ];
    }
}
