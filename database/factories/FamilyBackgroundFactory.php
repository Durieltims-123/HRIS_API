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
        $number = 1;
        return [
            'personal_data_sheet_id' => $number++,
            'spouse_surname' => $this->faker->name(),
            'spouse_first_name' => $this->faker->name(),
            'spouse_middle_name' => $this->faker->name(),
            'name_extension' => $this->faker->randomElement(['Jr','Sr.','II','III']),
            'occupation' => $this->faker->unique()->text(1),
            'employee_business_name' => $this->faker->unique()->text(1),
            'business_address'=> $this->faker->unique()->text(1),
            'telephone_number'=> $this->faker->tollFreePhoneNumber(),
            'father_surname' => $this->faker->name(),
            'father_first_name'  => $this->faker->name(),
            'father_middle_name'  => $this->faker->name(),
            'father_extension_name'  => $this->faker->randomElement(['Jr','Sr.','II','III']),
            'mother_maiden_surname' => $this->faker->name(),
            'mother_first_name' => $this->faker->name(),
            'mother_maiden_middle_name' => $this->faker->name(),
        ];
    }
}
