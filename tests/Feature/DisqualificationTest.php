<?php

namespace Tests\Feature;

use App\Models\Assessment;
use Tests\TestCase;
use App\Models\User;
use App\Models\Disqualification;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisqualificationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_disqualification(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    // index
    public function test_disqualification_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/disqualification');
        $response->assertStatus(200);
    }

    public function test_add_disqualification():void
    {
        $formData = [
            "reason" => 'TestReason',
            'application_id' => '5',
            'date_disqualified' => '2023-01-02',
            'member_id' => '1',
            'training' => '5',
            'performance' => '5',
            'education' => '5',
            'experience' => '5'
        ];
        $disqualificationData = [
            "reason" => 'TestReason',
            'application_id' => '5',
            'date_disqualified' => '2023-01-02',
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/disqualification', $formData);
        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('disqualifications', $disqualificationData);   
    }
    // edit 
    // public function test_edit_disqualification(): void
    // {
    //     $formData = [
    //         "reason" => 'UpdateTestReason',
    //         'application_id' => '5',
    //         'date_disqualified' => '2023-01-03',
    //         'member_id' => '1',
    //         'training' => '7',
    //         'performance' => '7',
    //         'education' => '5',
    //         'experience' => '5'
    //     ];
    //     $disqualificationData = [
    //         "reason" => 'UpdateTestReason',
    //         'application_id' => '5',
    //         'date_disqualified' => '2023-01-03',
    //     ];
    //     $disqualification = Disqualification::where([['application_id', '5'],['date_disqualified','2023-01-02']])->first();

    //     $user = User::factory()->create();
    //     $this->assertCount(0, $user->tokens);
    //     $this->actingAs($user);
    //     $this->patch('/api/disqualification/' . $disqualification->id, $formData);

    //     // this check if it updated in the database 
    //     $response = $this->assertDatabaseHas('disqualifications', $disqualificationData);
    // }

    // delete 
    public function test_delete_disqualification(): void
    {
        $disqualificationData = [
            "reason" => 'UpdateTestReason',
            'application_id' => '5',
            'date_disqualified' => '2023-01-02',
        ];
        $dept = Disqualification::where([['application_id', '5'],['date_disqualified','2023-01-02']])->first();
        Assessment::where('application_id', 5)->delete();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/disqualification/' . $dept->id);
        $response = $this->assertDatabaseMissing('disqualifications', $disqualificationData);
    }

}
