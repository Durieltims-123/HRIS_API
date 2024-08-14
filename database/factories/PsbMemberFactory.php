<?php

namespace Database\Factories;

use App\Models\PersonnelSelectionBoard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PsbMember>
 */
class PsbMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'position' => fake()->word(),
            'personnel_selection_board_id' => function () {
                return PersonnelSelectionBoard::factory()->create()->id;
            },
        ];
    }
}
