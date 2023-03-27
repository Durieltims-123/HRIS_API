<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QualificationStandard>
 */
class QualificationStandardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $number = 1;
        return [
            'position_id' => $number++,
            'education' => $this->faker->unique()->text(),
            'training' => $this->faker->unique()->text(),
            'experience' => $this->faker->unique()->text(),
            'eligibility' => $this->faker->unique()->text(),
            'competency' => $this->faker->unique()->text(),
        ];
    }
}
