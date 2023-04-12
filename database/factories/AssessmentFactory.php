<?php

namespace Database\Factories;

use App\Models\PsbMember;
use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assessment>
 */
class AssessmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $psb_members = PsbMember::all();
        $applications = Application::all();
        return [
            'application_id' => $applications->random()->id,
            'member_id' => $psb_members->random()->id,
            'training' => fake()->randomDigit(),
            'performance' => fake()->randomDigit(),
            'education' => fake()->randomDigit(),
            'experience' => fake()->randomDigit(),
            'psychological_attribute' => fake()->randomDigit(),
            'potential' => fake()->randomDigit(),
            'awards' => fake()->randomDigit(),
            'additional_information' => fake()->sentence(),
            'remarks' => fake()->sentence(),
            'date_of_assessment' => fake()->date('Y-m-d'),
        ];
    }
}
