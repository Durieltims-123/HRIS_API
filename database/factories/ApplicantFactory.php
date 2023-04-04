<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Applicant>
 */
class ApplicantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
             'first_name' => $this->faker->name(),
             'middle_name' => $this->faker->name(),
             'last_name' => $this->faker->name(),
             'suffix_name' => $this->faker->randomElement(['Jr.', 'II', 'Sr.', 'III']),
             'contact_number' => $this->faker->randomElement(['09111111111', '09222222222', '09333333333', '09444444444','09555555555']),
             'email_address' => $this->faker->safeEmail(),
        ];
    }
}
