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
    public function test_plantilla_link(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // index
    public function test_plantilla_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/plantilla');
        $response->assertStatus(200);
    }

    // add
    public function test_add_plantilla(): void
    {
        $formData = [
            "office_id" => 1,
            "position_id" => 1,
            'item_number' => "Lorep Ipsum Test5467",
            'place_of_assignment' => "Lorep Ipsum Test",
            'year' =>  "2012",
            'description' => "Lorep Ipsum Test",
            'lgu_position_id' => 1
        ];
        $plantillaData = [
            "office_id" => 1,
            "position_id" => 1,
            'item_number' => "Lorep Ipsum Test5467",
            'place_of_assignment' => "Lorep Ipsum Test",
            'year' => "2012",
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/plantilla', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('lgu_positions', $plantillaData);
    }

    // edit 
    public function test_edit_plantilla(): void
    {
        $formData = [
            'item_number' => "UpdateLorep Ipsum Test5467",
            'place_of_assignment' => "UpdateLorep Ipsum Test",
            'year' =>  "2012",
            'description' => "UpdateLorep Ipsum Test",
        ];
        $plantillaData = [
            'item_number' => "UpdateLorep Ipsum Test5467",
            'place_of_assignment' => "UpdateLorep Ipsum Test",
            'year' =>  "2012",
        ];
        $instance = LguPosition::where("item_number", "Lorep Ipsum Test5467")->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/plantilla/' . $instance->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('lgu_positions', $plantillaData);
    }

       // delete 
       public function test_delete_plantilla(): void
       {

           $plantillaData =[
            'item_number' => "234",
            'place_of_assignment' => "IT Office",
            'year' =>  "2012",
            ];
           $instance = LguPosition::where([["item_number", "234"],['place_of_assignment','IT Office']])->first();
           $user = User::factory()->create();
           $this->assertCount(0, $user->tokens);
           $this->actingAs($user);
           $this->delete('/api/plantilla/' . $instance->id);
           $response = $this->assertDatabaseMissing('lgu_positions', $plantillaData);
       }
}
