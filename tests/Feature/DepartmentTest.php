<?php

namespace Tests\Feature;

use App\Models\Office;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OfficeTest extends TestCase
{
    // link
    public function test_office_link(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // index
    public function test_office_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/office');
        $response->assertStatus(200);
    }

    // add
    public function test_add_office(): void
    {
        $formData = [
            "office_code" => "456",
            "office_name" => "Test Dept",
            'division_code' => ["TestOne",'TestTwo'],
            'division_name' => ["Lorep One", "Ipsum Two"],
                      
        ];
        $officeData = [
            "office_code" => "456",
            "office_name" => "Test Dept",
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/office', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('offices', $officeData);
    }

    // edit 
    public function test_edit_office(): void
    {
        $formData = [
            "office_code" => "updated456",
            "office_name" => "updatedTest Dept",
            'division_code' => ["updatedTestOne",'updatedTestTwo'],
            'division_name' => ["updatedLorep One", "updatedIpsum Two"],
                      
        ];
        $officeData = [
            "office_code" => "updated456",
            "office_name" => "updatedTest Dept",
        ];
        $sg = Office::where([["office_code", "456"], ["office_name", "Test Dept"]])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/office/' . $sg->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('offices', $officeData);
    }

    // delete 
    public function test_delete_office(): void
    {
        $formData = [
            "office_code" => "updated456",
            "office_name" => "updatedTest Dept",
        ];
        $dept = Office::where([["office_code", "updated456"], ["office_name", "updatedTest Dept"]])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/office/' . $dept->id);
        $response = $this->assertDatabaseMissing('offices', $formData);
    }
}
