<?php

namespace Database\Factories;

use App\Models\PersonalDataSheet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VoluntaryWork>
 */
class PDSVoluntaryWorkFactory extends Factory
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
            'organization_name' => $this->faker->sentence(),
            'organization_address' => $this->faker->address(),
            'number_of_hours' => $this->faker->randomDigit(),
            'position_nature_of_work' => $this->faker->sentence(),
            'date_from' => $this->faker->date('Y-m-d'),
            'date_to'  => $this->faker->date('Y-m-d'),
        ];
    }
}
