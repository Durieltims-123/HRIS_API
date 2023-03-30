<?php

namespace Database\Factories;

use App\Models\PersonalDataSheet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VoluntaryWork>
 */
class VoluntaryWorkFactory extends Factory
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
            'organization_name' => $this->faker->text(1),
            'organization_address' => $this->faker->text(1),
            'position' => $this->faker->text(1),
            'number_hours' => $this->faker->number(),
            'vw_inclusive_dates_from' => $this->faker->date(),
            'vw_inclusive_dates_to'  => $this->faker->date(),
        ];
    }
}
