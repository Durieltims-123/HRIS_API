<?php

namespace Database\Factories;

use App\Models\Division;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $division = Division::all();
        return [
            'division_id' => $division->random()->id,
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'suffix_name' => $this->faker->randomElement(['Jr.', 'II', 'Sr.', 'III', ' ']),
            'contact_number' => $this->faker->randomElement(['09111111111', '09222222222', '09333333333', '09444444444', '09555555555']),
            'email_address' => $this->faker->safeEmail(),
            'lgu_position_id' => $this->faker->randomElement(['1', '2']),
            'employee_status' => $this->faker->randomElement(['Active', 'Terminated', 'Resigned', 'Retired', 'Suspended', 'On-Leave']),
            'orientation_status' => $this->faker->randomElement(['Pending', 'Completed']),
        ];
    }
}
