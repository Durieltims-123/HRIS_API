<?php

namespace Tests\Feature;

use App\Models\Division;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DivisionTest extends TestCase
{
    // link
    public function test_division_link(): void
    {
        $response = $this->get("/");
        $response->assertStatus(200);
    }

    // index
    public function test_division_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get("/api/division");
        $response->assertStatus(200);
    }

    // add
    public function test_add_division(): void

    {
        $formData = [
            "code" => "DT",
            "name" => "Division Test",
            "office_id" => 15,
            "type" => "Unit",
        ];
        $divisionData = [
            "division_code" => "DT",
            "division_name" => "Division Test",
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post("/api/division", $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas("divisions", $divisionData);
    }

    // edit 
    public function test_edit_division(): void
    {
        $formData = [
            "code" => "UDT",
            "name" => "Update Division Test",
            "office_id" => 15,
            "type" => "Division",
        ];
        $divisionData = [
            "division_code" => "UDT",
            "division_name" => "Update Division Test",
            "office_id" => 15,
            "division_type" => "Division",
        ];
        $sg = Division::where([["division_code", "DT"], ["division_name", "Division Test"]])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch("/api/division/" . $sg->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas("divisions", $divisionData);
    }

    // delete 
    public function test_delete_division(): void
    {
        $formData = [
            "division_code" => "UDT",
            "division_name" => "Update Division Test",
            "office_id" => 15,
            "division_type" => "Division",
            'deleted_at' => null
        ];
        $dept = Division::where([["division_code", "UDT"], ["division_name", "Update Division Test"]])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete("/api/division/" . $dept->id);
        $response = $this->assertDatabaseMissing("divisions", $formData);
    }
}
