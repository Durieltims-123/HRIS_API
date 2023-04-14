<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Publication;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_publication(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // index
    public function test_publication_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/publication');
        $response->assertStatus(200);
    }

    // add
    public function test_add_publication(): void
    {
        $formData = [
            "opening_date" => "2023-03-05",
            'closing_date' => "2023-04-01",
            "vacancy_id" => 1,
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/publication', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('publications', $formData);
    }

    // edit 
    public function test_edit_publication(): void
    {
        $formData = [
            "opening_date" => "2023-10-05",
            'closing_date' => "2023-10-12",
            "vacancy_id" => 1,
        ];
        $publication = Publication::where("vacancy_id", 1)->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/publication/' . $publication->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('publications', $formData);
    }

    // delete 
    public function test_delete_publication(): void
    {
        $formData = [
            "opening_date" => "2023-10-06",
            'closing_date' => "2023-10-11",
            "vacancy_id" => 1,
        ];
        $dept = Publication::where([['vacancy_id',1],["opening_date", "2023-10-05"], ["closing_date", "2023-10-12"]])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/publication/' . $dept->id);
        $response = $this->assertDatabaseMissing('publications', $formData);
    }
}
