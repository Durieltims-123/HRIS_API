<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Question;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionsTest extends TestCase
{
    // link
    public function test_question_link(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // index
    public function test_question_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/question');
        $response->assertStatus(200);
    }

    // add
    public function test_add_question(): void
    {
        $formData = [
            "number" => 1,
            "question" => "First Question",
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/question', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('questions', $formData);
    }



    // edit 
    public function test_edit_question(): void
    {
        $formData = [
            'number' => "5 a",
            'question' => "third question",
        ];
        $sg = Question::where([["number", "1"], ["question", "First question"]])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/question/' . $sg->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('questions', $formData);
    }

    // delete 
    public function test_delete_question(): void
    {
        $formData = [
            'number' => "5 a",
            'question' => "third question",
            'deleted_at' => null
        ];
        $sg = Question::where([["number", "5 a"], ["question", "third question"]])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/question/' . $sg->id);
        $response = $this->assertDatabaseMissing('questions', $formData);
    }
}
