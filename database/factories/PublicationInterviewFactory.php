<?php

namespace Database\Factories;

use App\Models\Interview;
use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PublicationInterview>
 */
class PublicationInterviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $publications = Publication::all();
        return [
            'publication_id' => $publications->random()->id,
            'interview_id' => function () {
                return Interview::factory()->create()->id;
            },
            
        ];
    }
}
