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
            'spouse_surname' => $this->faker->name(),
            'spouse_first_name' => $this->faker->name(),
            'spouse_middle_name' => $this->faker->name(),
            'suffix_name' => $this->faker->randomElement(['Jr','Sr.','II','III']),
            'occupation' => $this->faker->unique()->text(),
            'employee_business_name' => $this->faker->unique()->text(),
            'business_address'=> $this->faker->unique()->text(),
            'telephone_number'=> $this->faker->phoneNumber(),
            'father_surname' => $this->faker->lastName(),
            'father_first_name'  => $this->faker->firstNameMale(),
            'father_middle_name'  => $this->faker->lastName(),
            'father_extension_name'  => $this->faker->randomElement(['Jr','Sr.','II','III']),
            'mother_maiden_surname' => $this->faker->lastName(),
            'mother_first_name' => $this->faker->firstNameFemale(),
            'mother_maiden_middle_name' => $this->faker->lastName(),
        ];
    }
}
