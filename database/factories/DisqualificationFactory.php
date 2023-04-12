<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Disqualification>
 */
class DisqualificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $number = 6;
        return [
            'application_id' => $number++,
            'date_disqualified' => fake()->date('Y-m-d'),
            'reason' => fake()->sentence(),
        ];
    }
}
