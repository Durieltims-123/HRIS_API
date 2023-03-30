<?php

namespace Database\Factories;

use Faker\Guesser\Name;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReferencesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'personal_data_sheet_id'
            'name' => $this->faker->name(),
            'address' => $this->faker->text(),
            'telephone_number' => $this->faker->telephone(),
        ];
    }
}
