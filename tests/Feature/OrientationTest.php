<?php

namespace Tests\Feature;

use App\Models\Orientation;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrientationTest extends TestCase
{
    // link
    public function test_orientation_link(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // index
    public function test_orientation_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/orientation');
        $response->assertStatus(200);
    }

    // add
    public function test_add_orientation(): void
    {
        $formData = [
            'date_generated' => "2000-01-01",
            'start_date' => "2000-01-01",
            'end_date' => "2000-01-01",
            'venue' => "sidi",
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/orientation', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('orientations', $formData);
    }



    // edit 
    public function test_edit_orientation(): void
    {
        $formData = [
            'date_generated' => "2000-01-01",
            'start_date' => "2000-01-01",
            'end_date' => "2000-01-01",
            'venue' => "sidi ngarud 1",
        ];
        $sg = Orientation::where([["venue", "sidi"], ["date_generated", "2000-01-01"]])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/orientation/' . $sg->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('orientations', $formData);
    }

    // delete 
    public function test_delete_orientation(): void
    {
        $formData = [
            'date_generated' => "2000-01-01",
            'start_date' => "2000-01-01",
            'end_date' => "2000-01-01",
            'venue' => "sidi ngarud 1",
            'deleted_at' => null
        ];
        $sg = Orientation::where([["venue", "sidi ngarud 1"], ["date_generated", "2000-01-01"]])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/orientation/' . $sg->id);
        $response = $this->assertDatabaseMissing('orientations', $formData);
    }
}
