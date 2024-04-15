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
            'position' => 'Test Position',
            'position_id' => 1,
            'date_submitted' => '2023-01-01',
            'posting_date' => '2023-01-18',
            'closing_date' => '2023-01-22',
            'date_queued' => null,
            'date_approved' => '2023-01-11',
            'status' => 'Active',
        ];


        $checkData = [
            'lgu_position_id' => 1,
            'date_submitted' => '2023-01-01',
            'status' => 'Active',
        ];


        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/vacancy', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('vacancies', $checkData);
    }

    // edit 
    public function test_edit_vacancy(): void
    {
        $formData = [
            'position' => 'Test Position Edit',
            'position_id' => 1,
            'date_submitted' => '2023-01-02',
            'date_approved' => '2023-01-11',
            'posting_date' => '2023-01-18',
            'closing_date' => '2023-01-22',
            'date_queued' => null,
            'status' => 'Active',
        ];


        $checkData = [
            'lgu_position_id' => 1,
            'date_submitted' => '2023-01-02',
            'status' => 'Active',
        ];

        $sg = Vacancy::where([["date_submitted", "2023-01-01"], ["status", "Active"]])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/vacancy/' . $sg->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('vacancies', $checkData);
    }

    // delete 
    public function test_delete_vacancy(): void
    {
        $checkData = [
            'lgu_position_id' => 1,
            'date_submitted' => '2023-01-02',
            'status' => 'Active',
        ];


        $vacancy = Vacancy::where([["date_submitted", "2023-01-02"], ["status", "Active"]])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/vacancy/' . $vacancy->id);
        var_dump($vacancy);
        $response = $this->assertDatabaseMissing('vacancies', $checkData);
    }
}
