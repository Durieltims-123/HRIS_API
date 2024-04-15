<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Position;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PositionTest extends TestCase
{
    // link
    public function test_position_link(): void
    {
        $response = $this->get("/");
        $response->assertStatus(200);
    }

    // index
    public function test_position_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get("/api/position");
        $response->assertStatus(200);
    }

    // add
    public function test_add_position(): void
    {
        $formData = [
            "code" => "Test Code",
            "title" => "Test Title",
            "salary_grade_id" => 1,
            "education" => "Lorem Ipsum",
            "training" => "Lorem Ipsum",
            "experience" => "Lorem Ipsum",
            "eligibility" => "Lorem Ipsum",
            "competency" => "Lorem Ipsum"
        ];

        $positionData = [
            "salary_grade_id" => 1,
            "code" => "Test Code",
            "title" => "Test Title"
        ];

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post("/api/position", $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas("positions", $positionData);
    }

    // edit 
    public function test_edit_position(): void
    {
        $formData = [
            "code" => "Test Code Edit",
            "title" => "Test Title Edit",
            "salary_grade_id" => 1,
            "education" => "Lorem Ipsum",
            "training" => "Lorem Ipsum",
            "experience" => "Lorem Ipsum",
            "eligibility" => "Lorem Ipsum",
            "competency" => "Lorem Ipsum"
        ];

        $positionData = [
            "code" => "Test Code Edit",
            "title" => "Test Title Edit",
            "salary_grade_id" => 1
        ];

        $instance = Position::where([["salary_grade_id", 1], ["title", "Test Title"], "code" => "Test Code",])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch("/api/position/" . $instance->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas("positions", $positionData);
    }

    // delete 
    public function test_delete_position(): void
    {

        $positionData = [
            "code" => "Test Code Edit",
            "title" => "Test Title Edit",
            "salary_grade_id" => 1
        ];

        $instance = Position::where([["salary_grade_id", 1], ["title", "Test Title Edit"], "code" => "Test Code Edit",])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete("/api/position/" . $instance->id);
        $response = $this->assertDatabaseMissing("positions", $positionData);
    }
}
