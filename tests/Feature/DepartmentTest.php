<?php

namespace Tests\Feature;

use App\Models\Department;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentTest extends TestCase
{
    // link
    public function test_department_link(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // index
    public function test_department_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/department');
        $response->assertStatus(200);
    }

    // add
    public function test_add_department(): void
    {
        $formData = [
            "department_code" => "456",
            "department_name" => "Test Dept",
            'office_code' => ["TestOne",'TestTwo'],
            'office_name' => ["Lorep One", "Ipsum Two"],
                      
        ];
        $departmentData = [
            "department_code" => "456",
            "department_name" => "Test Dept",
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/department', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('departments', $departmentData);
    }

    // edit 
    public function test_edit_department(): void
    {
        $formData = [
            "department_code" => "updated456",
            "department_name" => "updatedTest Dept",
            'office_code' => ["updatedTestOne",'updatedTestTwo'],
            'office_name' => ["updatedLorep One", "updatedIpsum Two"],
                      
        ];
        $departmentData = [
            "department_code" => "updated456",
            "department_name" => "updatedTest Dept",
        ];
        $sg = Department::where([["department_code", "456"], ["department_name", "Test Dept"]])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/department/' . $sg->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('departments', $departmentData);
    }

    // delete 
    public function test_delete_department(): void
    {
        $formData = [
            "department_code" => "updated456",
            "department_name" => "updatedTest Dept",
        ];
        $dept = Department::where([["department_code", "updated456"], ["department_name", "updatedTest Dept"]])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/department/' . $dept->id);
        $response = $this->assertDatabaseMissing('departments', $formData);
    }
}
