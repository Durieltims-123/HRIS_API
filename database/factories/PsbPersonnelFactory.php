<?php

namespace Database\Factories;

use App\Models\PersonnelSelectionBoard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PsbMember>
 */
class PsbPersonnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'prefix' => fake()->word(),
            'name' => fake()->name(),
            'position' => fake()->word(),
            'office' => fake()->address(),
            'personnel_selection_board_id' => function () {
                return PersonnelSelectionBoard::factory()->create()->id;
            },
            'role' => $this->faker->randomElement(['member', 'secretariat']),
        ];
    }
}
