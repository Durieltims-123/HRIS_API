<?php

namespace Database\Factories;

use App\Models\Division;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LGUPosition>
 */
class LguPositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $positions = Position::all();
        $divisions = Division::all();

        return [
             'division_id' =>$divisions->random()->id,
             'position_id' => $positions->random()->id, 
             'item_number' => $this->faker->randomDigit(),
             'place_of_assignment' => '', 
             'year' => '2023', 
             'position_status' => $this->faker->randomElement(['Permanent', 'Casual', 'Elective', 'Coterminous', 'Contractual']),
        ];
    }
}
