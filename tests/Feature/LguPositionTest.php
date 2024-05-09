<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\LguPosition;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LguPositionTest extends TestCase
{
    // link
    public function test_lgu_position_link(): void
    {
        $response = $this->get("/");
        $response->assertStatus(200);
    }

    // index
    public function test_lgu_position_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get("/api/lgu-position");
        $response->assertStatus(200);
    }

    // add
    public function test_add_lgu_position(): void
    {
        $formData = [
            "division_id" => 1,
            "position_id" => 1,
            "item_number" => "12345",
            "place_of_assignment" => null,
            "description" => null,
            "year" =>  "2023-01-01",
            "position_status" => "permanent",
            "status" => "Active"
        ];

        $lgu_positionData = [
            "division_id" => 1,
            "position_id" => 1,
            "item_number" => "12345",
            "place_of_assignment" => null,
            "year" =>  "2023-01-01",
            "position_status" => "permanent",
            "status" => "Active"
        ];

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post("/api/lgu-position", $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas("lgu_positions", $lgu_positionData);
    }

    // edit 
    public function test_edit_lgu_position(): void
    {
        $formData = [
            "division_id" => 2,
            "position_id" => 2,
            "item_number" => "12345",
            "place_of_assignment" => "PASSO",
            "description" => "CPA",
            "year" =>  "2024-01-01",
            "position_status" => "permanent",
            "status" => "Active"
        ];

        $lgu_positionData = [
            "division_id" => 2,
            "position_id" => 2,
            "item_number" => "12345",
            "place_of_assignment" => "PASSO",
            "year" =>  "2024",
            "position_status" => "permanent",
            "status" => "Active"
        ];
        $instance = LguPosition::where("item_number", "12345")->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch("/api/lgu-position/" . $instance->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas("lgu_positions", $lgu_positionData);
    }

    // delete 
    public function test_delete_lgu_position(): void
    {

        $lgu_positionData = [
            "division_id" => 2,
            "position_id" => 2,
            "item_number" => "12345",
            "place_of_assignment" => "PASSO",
            "year" =>  "2024",
            "position_status" => "permanent",
            "status" => "Active",
            'deleted_at' => null
        ];
        $instance = LguPosition::where("item_number", "12345")->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete("/api/lgu-position/" . $instance->id);
        $response = $this->assertDatabaseMissing("lgu_positions", $lgu_positionData);
    }
}
