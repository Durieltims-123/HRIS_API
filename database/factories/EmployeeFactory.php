<?php

namespace Database\Factories;

use App\Models\Division;
use App\Models\Employee;
use App\Models\LguPosition;
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
        $lgu_position = LguPosition::all()->random();

        return [
            'division_id' => $lgu_position->division_id,
            'employee_id' => $this->faker->numerify('###########'),
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'suffix_name' => $this->faker->randomElement(['Jr.', 'II', 'Sr.', 'III', ' ']),
            'contact_number' => $this->faker->randomElement(['09111111111', '09222222222', '09333333333', '09444444444', '09555555555']),
            'email_address' => $this->faker->safeEmail(),
            'lgu_position_id' =>  $lgu_position->id,
            'employee_status' => $this->faker->randomElement(['Active', 'Terminated', 'Resigned', 'Retired', 'Suspended', 'On-Leave']),
            'employment_status' => $this->faker->randomElement(['permanent', 'casual', 'coterminous', 'fixed term', 'contractual', 'substitute', 'provisional']),
            'orientation_status' => $this->faker->randomElement(['Pending', 'Completed']),
        ];
    }
}
