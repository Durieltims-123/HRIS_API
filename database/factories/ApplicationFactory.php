<?php

namespace Database\Factories;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $publications = Publication::all();
        static $number = 1;
        // Did not yet Added Data for Employee
        return [
            'applicant_id' => $number++,
            'publication_id' => $publications->random()->id,
            'submission_date' => fake()->date('Y-m-d'),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->lastName(),
            'last_name' => fake()->lastName(),
            'suffix' => fake()->suffix(),
            'application_type' => fake()->word(),
            'status' => fake()->word(),
        ];
    }
}
