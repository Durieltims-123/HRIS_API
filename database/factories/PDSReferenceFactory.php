<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PDSReferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $number = 1;
        return
            [
                'personal_data_sheet_id' => $number++,
                'name' => fake()->name(),
                'address' => fake()->address(),
                'number' => fake()->numerify('09#########')
            ];
    }
}
