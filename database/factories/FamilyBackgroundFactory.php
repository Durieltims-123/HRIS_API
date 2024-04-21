<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FamilyBackground>
 */
class FamilyBackgroundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $number = 1;
        return [
            'personal_data_sheet_id' => $number++,
            'spouse_first_name' => $this->faker->lastName(),
            'spouse_middle_name' => $this->faker->lastName(),
            'spouse_last_name' => $this->faker->name(),
            'spouse_suffix' => $this->faker->randomElement(['Jr', 'Sr.', 'II', 'III']),
            'spouse_occupation' => $this->faker->unique()->text(),
            'spouse_employer' => $this->faker->unique()->text(),
            'spouse_employer_address' => $this->faker->unique()->text(),
            'spouse_employer_telephone' => $this->faker->phoneNumber(),
            'father_first_name' => $this->faker->lastName(),
            'father_middle_name'  => $this->faker->firstNameMale(),
            'father_last_name'  => $this->faker->lastName(),
            'father_suffix'  => $this->faker->randomElement(['Jr', 'Sr.', 'II', 'III']),
            'mother_first_name' => $this->faker->lastName(),
            'mother_middle_name' => $this->faker->firstNameFemale(),
            'mother_last_name' => $this->faker->lastName(),
            'mother_suffix'  => $this->faker->randomElement(['Jr', 'Sr.', 'II', 'III'])
        ];
    }
}
