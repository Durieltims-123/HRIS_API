<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $num = 1;
        return [
            'plantilla_id' => $num++,
            'date_submitted' => fake()->date('Y-m-d'),
            'date_queued' => fake()->date('Y-m-d'),
            'date_approved' => fake()->date('Y-m-d'),
            'status' => fake()->word()
        ];
    }
}
