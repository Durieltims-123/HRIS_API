<?php

namespace Database\Factories;

use App\Models\PersonalDataSheet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MembershipAssociation>
 */
class MembershipAssociationFactory extends Factory
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
            'membership_association' => $this->faker->text(1),
        ];
    }
}