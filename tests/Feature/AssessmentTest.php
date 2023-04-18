<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Assessment;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssessmentTest extends TestCase
{
    
    public function test_assessment(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // index
    public function test_assessment_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/assessment');
        $response->assertStatus(200);
    }

    public function test_add_assessment():void
    {
        $formData = [
            'application_id' => 6,
            'member_id' => [1,2],
            'training' => ['5','8'],
            'performance' => ['5','8'],
            'education' => ['5','8'],
            'experience' => ['5','8'],
            'psychological_attribute' => ['5','8'],
            'potential' => ['5','8'],
            'awards' => ['5','8'],
            'additional_information' => ['TestAdditional', 'TestAdditionalTwo'],
            'remarks' => ['TestRemarks','TestRemarksTwo'],
            'date_of_assessment' => ['2023-01-02','2023,02-02'],
            
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/assessment', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('assessments', $formData);   
    }
    // edit 
    public function test_edit_assessment(): void
    {
        $formData = [
            'application_id' => 6,
            'member_id' => [1,2],
            'training' => ['5','9'],
            'performance' => ['5','9'],
            'education' => ['5','9'],
            'experience' => ['5','9'],
            'psychological_attribute' => ['5','9'],
            'potential' => ['5','9'],
            'awards' => ['5','9'],
            'additional_information' => ['UpdateTestAdditional', 'UpdateTestAdditionalTwo'],
            'remarks' => ['UpdateTestRemarks','UpdateTestRemarksTwo'],
            'date_of_assessment' => ['2023-01-02','2023,02-02'],
            
        ];
        $assessment = Assessment::where('application_id', 6)->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/assessment/' . $assessment->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('assessments', $formData);
    }

    // delete 
    public function test_delete_assessment(): void
    {
        $formData = [
            'application_id' => 6,
            'member_id' => [1,2],
            'training' => ['5','9'],
            'performance' => ['5','9'],
            'education' => ['5','9'],
            'experience' => ['5','9'],
            'psychological_attribute' => ['5','9'],
            'potential' => ['5','9'],
            'awards' => ['5','9'],
            'additional_information' => ['UpdateTestAdditional', 'UpdateTestAdditionalTwo'],
            'remarks' => ['UpdateTestRemarks','UpdateTestRemarksTwo'],
            'date_of_assessment' => ['2023-01-02','2023,02-02'],
            
        ];
        
        $assessment = Assessment::where('application_id', 6)->get();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        foreach($assessment as $data){
            $this->delete('/api/assessment/' . $data->id);
        }
        $response = $this->assertDatabaseMissing('assessments', $formData);
    }
}
