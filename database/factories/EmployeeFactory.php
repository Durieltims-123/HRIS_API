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
             'first_name' => $this->faker->name(),
             'middle_name' => $this->faker->name(),
             'last_name' => $this->faker->name(),
             'suffix_name' => $this->faker->randomElement(['Jr.', 'II', 'Sr.', 'III',' ']),
             'contact_number' => $this->faker->randomElement(['09111111111', '09222222222', '09333333333', '09444444444','09555555555']),
             'email_address' => $this->faker->safeEmail(),
             'current_position' => $this->faker->randomElement(['Administrative Divisionr V', 'Nurse I', 'Administrative Divisionr III', 'Programmer I', 'Administrative I']),
             'employment_status' => $this->faker->randomElement(['Regular', 'Casual', 'Project', 'Seasonal','Fixed-Term','Probationary']),
             'employee_status' => $this->faker->randomElement(['Active', 'Terminated', 'Retired', 'Suspended','On-Leave']),
             'orientation_status' => $this->faker->randomElement(['Waiting','Ongoing', 'Finished']),
        ];
    }
}
