<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Applicant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicantTest extends TestCase
{
 // link
 public function test_applicant_link(): void
 {
     $response = $this->get('/');
     $response->assertStatus(200);
 }

 // index
 public function test_applicant_index(): void
 {
     $user = User::factory()->create();
     $this->assertCount(0, $user->tokens);
     $this->actingAs($user);
     $response = $this->get('/api/applicant');
     $response->assertStatus(200);
 }

 // add
 public function test_add_applicant(): void
 {
     $formData = [
        'first_name' => "Fname test",
        'middle_name' => "aw",
        'last_name' => "aw",
        'suffix_name' => "jr.",
        'contact_number' => "0987654321",
        'email_address' => "aw@gmail.com",
     ];
     $user = User::factory()->create();
     $this->assertCount(0, $user->tokens);
     $this->actingAs($user);
     $this->post('/api/applicant', $formData);

     // this will check if it is inserted in the database
     $response = $this->assertDatabaseHas('applicants', $formData);
 }



 // edit 
 public function test_edit_applicant(): void
 {
     $formData = [
        'first_name' => "working first",
        'middle_name' => "working",
        'last_name' => "aw",
        'suffix_name' => "jr.",
        'contact_number' => "0987654321",
        'email_address' => "aw@gmail.com",
     ];
     $sg = Applicant::where([["first_name", "Fname test"], ["middle_name", "aw"]])->first();

     $user = User::factory()->create();
     $this->assertCount(0, $user->tokens);
     $this->actingAs($user);
     $this->patch('/api/applicant/' . $sg->id, $formData);

     // this check if it updated in the database 
     $response = $this->assertDatabaseHas('applicants', $formData);
 }

 // delete 
 public function test_delete_applicant(): void
 {
     $formData = [
        'first_name' => "working first",
        'middle_name' => "working",
        'last_name' => "aw",
        'suffix_name' => "jr.",
        'contact_number' => "0987654321",
        'email_address' => "aw@gmail.com",
     ];
     $sg = Applicant::where([["first_name", "working first"], ["middle_name", "working"]])->first();
     $user = User::factory()->create();
     $this->assertCount(0, $user->tokens);
     $this->actingAs($user);
     $this->delete('/api/applicant/' . $sg->id);
     $response = $this->assertDatabaseMissing('applicants', $formData);
 }
}
