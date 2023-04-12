<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\employee;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class employeeTest extends TestCase
{
 // link
 public function test_employee_link(): void
 {
     $response = $this->get('/');
     $response->assertStatus(200);
 }

 // index
 public function test_employee_index(): void
 {
     $user = User::factory()->create();
     $this->assertCount(0, $user->tokens);
     $this->actingAs($user);
     $response = $this->get('/api/employee');
     $response->assertStatus(200);
 }

 // add
 public function test_add_employee(): void
 {
     $formData = [
        'office_id' => 2,
        'first_name' => "First name test",
        'middle_name' => "aw",
        'last_name' => "aw",
        'suffix_name' => "aw",
        'contact_number' => "aw",
        'email_address' => "aw",
        'current_position' => "aw",
        'employment_status' => "aw",
        'employee_status' => "aw",
        'orientation_status' => "aw",
     ];
     $user = User::factory()->create();
     $this->assertCount(0, $user->tokens);
     $this->actingAs($user);
     $this->post('/api/employee', $formData);

     // this will check if it is inserted in the database
     $response = $this->assertDatabaseHas('employees', $formData);
 }



 // edit 
 public function test_edit_employee(): void
 {
     $formData = [
        'office_id' => 2,
        'first_name' => "Edited aw",
        'middle_name' => "Edited2",
        'last_name' => "aw",
        'suffix_name' => "aw",
        'contact_number' => "aw",
        'email_address' => "aw",
        'current_position' => "aw",
        'employment_status' => "aw",
        'employee_status' => "aw",
        'orientation_status' => "aw",
     ];
     $sg = Employee::where([["first_name", "First name test"], ["middle_name", "aw"]])->first();

     $user = User::factory()->create();
     $this->assertCount(0, $user->tokens);
     $this->actingAs($user);
     $this->patch('/api/employee/' . $sg->id, $formData);

     // this check if it updated in the database 
     $response = $this->assertDatabaseHas('employees', $formData);
 }

 // delete 
 public function test_delete_employee(): void
 {
     $formData = [
        'office_id' => 2,
        'first_name' => "Edited aw",
        'middle_name' => "Edited2",
        'last_name' => "aw",
        'suffix_name' => "aw",
        'contact_number' => "aw",
        'email_address' => "aw",
        'current_position' => "aw",
        'employment_status' => "aw",
        'employee_status' => "aw",
        'orientation_status' => "aw",
     ];
     $sg = Employee::where([["first_name", "Edited aw"], ["middle_name", "Edited2"]])->first();
     $user = User::factory()->create();
     $this->assertCount(0, $user->tokens);
     $this->actingAs($user);
     $this->delete('/api/employee/' . $sg->id);
     $response = $this->assertDatabaseMissing('employees', $formData);
 }
}
