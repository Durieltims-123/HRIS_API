<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Notice;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoticeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_notice(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    // index
    public function test_notice_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/notice');
        $response->assertStatus(200);
    }

    public function test_add_notice():void
    {
        $formData = [
            "application_id" => '3',
            'notice_type' => 'Email',
            'date_sent' => '2023-01-02',
            'date_received' => '2023-01-02',
            
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/notice', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('notices', $formData);   
    }
    // edit 
    public function test_edit_notice(): void
    {
        $formData = [
            "application_id" => '3',
            'notice_type' => 'UpdateEmail',
            'date_sent' => '2023-01-02',
            'date_received' => '2023-01-02',
            
        ];
        $notice = Notice::where([['application_id', '3'],['notice_type','Email']])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/notice/' . $notice->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('notices', $formData);
    }

    // delete 
    public function test_delete_notice(): void
    {
        $formData = [
            "application_id" => '3',
            'notice_type' => 'UpdateEmail',
            'date_sent' => '2023-01-02',
            'date_received' => '2023-01-02',
            
        ];
        $notice = Notice::where([['application_id', '3'],['notice_type','UpdateEmail']])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/notice/' . $notice->id);
        $response = $this->assertDatabaseMissing('notices', $formData);
    }
}
