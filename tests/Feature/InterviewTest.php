<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Interview;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InterviewTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_interview(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // index
    public function test_interview_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/interview');
        $response->assertStatus(200);
    }

    // add
    public function test_add_interview(): void
    {
        $formData = [
            "interview_date" => "2023-03-05",
            'venue' => "testVenue",
            "publication_id" => [1, 2],
        ];
        $interviewData = [
            "interview_date" => "2023-03-05",
            'venue' => "testVenue",
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/interview', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('interviews', $interviewData);
    }

    // edit 
    public function test_edit_interview(): void
    {
        $formData = [
            "interview_date" => "2023-03-08",
            'venue' => "testUpdatedVenue",
            "publication_id" => [1, 2],
        ];
        $interviewData = [
            "interview_date" => "2023-03-08",
            'venue' => "testUpdatedVenue",
        ];
        $interview = Interview::where([['interview_date', '2023-03-05'], ['venue', 'testVenue']])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/interview/' . $interview->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('interviews', $interviewData);
    }

    // delete 
    public function test_delete_interview(): void
    {
        $interviewData = [
            "interview_date" => "2023-03-08",
            'venue' => "testUpdatedVenue",
            'deleted_at' => null
        ];
        $dept = Interview::where([['interview_date', '2023-03-08'], ['venue', 'testUpdatedVenue']])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/interview/' . $dept->id);
        $response = $this->assertDatabaseMissing('interviews', $interviewData);
    }
}
