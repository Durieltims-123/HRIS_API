<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Application;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_application(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // index
    public function test_application_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/application');
        $response->assertStatus(200);
    }

    public function test_add_application():void
    {
        $formData = [
            "applicant_id" => null,
            'employee_id' => '1',
            "publication_id" => '2',
            'submission_date' => '2023-01-02',
            'first_name' => 'TestName',
            'middle_name' => 'TestMiddle',
            'last_name' => 'TestLast',
            'suffix_name' => 'TestSuffix',
            'application_type' => 'Walk-in'
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/application', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('applications', $formData);   
    }
    // edit 
    public function test_edit_application(): void
    {
        $formData = [
            "applicant_id" => null,
            'employee_id' => 1,
            "publication_id" => 2,
            'submission_date' => '2023-01-01',
            'first_name' => 'UpdateTestName',
            'middle_name' => 'UpdateTestMiddle',
            'last_name' => 'UpdateTestLast',
            'suffix_name' => 'TestSuffix',
            'application_type' => 'UpdateWalk-in'
        ];
        $application = Application::where([['publication_id', 2],['first_name','TestName']])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/application/' . $application->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('applications', $formData);
    }

    // delete 
    public function test_delete_application(): void
    {
        $formData = [
            "applicant_id" => 1,
            'employee_id' => null,
            "publication_id" => 2,
            'submission_date' => '2023-01-01',
            'first_name' => 'UpdateTestName',
            'middle_name' => 'UpdateTestMiddle',
            'last_name' => 'UpdateTestLast',
            'suffix_name' => 'UpdateTestSuffix',
            'application_type' => 'UpdateWalk-in'
        ];
        $dept = Application::where([['publication_id', 2],['first_name','UpdateTestName'],['last_name','UpdateTestLast']])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/application/' . $dept->id);
        $response = $this->assertDatabaseMissing('applications', $formData);
    }
}
