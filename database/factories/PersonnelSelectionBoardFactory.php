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
            'date_of_effectivity' => fake()->date('Y-m-d'),
            'end_of_effectivity' => fake()->date('Y-m-d'),
            'presiding_officer_prefix' => "Mr.",
            'presiding_officer' => fake()->name(),
            'presiding_officer_position' => fake()->word(),
            'presiding_officer_office' => fake()->address(),
        ];
    }
}
