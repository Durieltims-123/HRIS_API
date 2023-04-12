<?php

namespace Database\Factories;

use App\Models\PersonnelSelectionBoard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonnelSelectionBoard>
 */
class PersonnelSelectionBoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PersonnelSelectionBoard::class;
    
    public function definition(): array
    {
        

        return [
            'start_date' => fake()->date('Y-m-d'),
            'end_date' => fake()->date('Y-m-d'),
            'chairman' => fake()->name(),
            'position' => fake()->word(),
            'status' => fake()->word()
        ];
    }
}
