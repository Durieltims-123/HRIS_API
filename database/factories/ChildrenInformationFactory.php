<?php

namespace Database\Factories;

use App\Models\FamilyBackground;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChildrenInformation>
 */
class ChildrenInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fams = FamilyBackground::all();
        $number = 1;
        return [
            'personal_data_sheet_id' => $number++,
            'family_background_id' => $fams->random()->id,
            'children_name' => $this->faker->name(),
            'children_birthdate' => $this->faker->name()
        ];
    }
}
