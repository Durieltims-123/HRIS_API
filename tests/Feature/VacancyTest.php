<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VacancyTest extends TestCase
{
    
    public function test_vacancy_link(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    
    // index
    public function test_vacancy_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/vacancy');
        $response->assertStatus(200);
    }

    // add
    public function test_add_vacancy(): void
    {
        $formData = [
            "date_submitted" => "2023-03-05",
            "status" => "Test Status",
            'date_queued' => "2023-01-01",
            'date_approved' => "2023-01-01",
            'lgu_position_id' => 1,
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/vacancy', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('vacancies', $formData);
    }

    // edit 
    public function test_edit_vacancy(): void
    {
        $formData = [
            "date_submitted" => "2023-03-07",
            "status" => "updatedTest Status",
            'date_queued' => "2023-01-01",
            'date_approved' => "2023-01-01",
            'lgu_position_id' => 1,
        ];
        $sg = Vacancy::where([["date_submitted", "2023-03-05"], ["status", "Test Status"]])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/vacancy/' . $sg->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('vacancies', $formData);
    }

    // delete 
    public function test_delete_vacancy(): void
    {
        $formData = [
            "date_submitted" => "2023-03-07",
            "status" => "updatedTest Status",
            'date_queued' => null,
            'date_approved' => null,
            'lgu_position_id' => 1,
        ];
        $dept = Vacancy::where([["date_submitted", "2023-03-07"], ["status", "updatedTest Status"]])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/vacancy/' . $dept->id);
        $response = $this->assertDatabaseMissing('vacancies', $formData);
    }
}
