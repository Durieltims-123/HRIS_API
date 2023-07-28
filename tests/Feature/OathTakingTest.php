<?php

namespace Tests\Feature;

use App\Models\OathTaking;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OathTakingTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_oathtaking(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // index
    public function test_oathtaking_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/oathtaking');
        $response->assertStatus(200);
    }

    // add
    public function test_add_oathtaking(): void
    {
        $formData = [
            "venue" => "TestVenue",
            "oath_date" => "2023-03-05",
            "date_generated" => "2023-03-06",
            "appointment_id" => ["2", "2"],
            "first_name" => ["TestFirst", 'TestFirstTwo'],
            "last_name" => ['TestLastOne', 'TestLastTwo'],
            "office" => ['TestOfficeOne', 'TestOfficeTwo'],
            "job_title" => ["TestTitle", "TestTitleTwo"],
            "date_appointed" => ["2023-01-01", "2023-02-02"]
        ];
        $oathTakingData = [
            "venue" => "TestVenue",
            "oath_date" => "2023-03-05",
            "date_generated" => "2023-03-06",
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/oathtaking', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('oath_takings', $oathTakingData);
    }

    // edit 
    public function test_edit_oathtaking(): void
    {
        $formData = [
            "venue" => "UpdateTestVenueOne",
            "oath_date" => "2023-04-07",
            "date_generated" => "2023-03-07",
            "appointment_id" => ["1", "1"],
            "first_name" => ["UpdateTestFirst", 'UpdateTestFirstTwo'],
            "last_name" => ['UpdateTestLastOne', 'UpdateTestLastTwo'],
            "office" => ['UpdateTestOfficeOne', 'UpdateTestOfficeTwo'],
            "job_title" => ["UpdateTestTitle", "UpdateTestTitleTwo"],
            "date_appointed" => ["2023-01-01", "2023-02-02"]
        ];
        $oathTakingData = [
            "venue" => "UpdateTestVenueOne",
            "oath_date" => "2023-04-07",
            "date_generated" => "2023-03-07",
        ];
        $psb = OathTaking::where([['venue', 'TestVenue'], ['oath_date', '2023-03-05']])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/oathtaking/' . $psb->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('oath_takings', $oathTakingData);
    }

    // delete 
    public function test_delete_oathtaking(): void
    {
        $oathTakingData = [
            "venue" => "UpdateTestVenueOne",
            "oath_date" => "2023-04-07",
            "date_generated" => "2023-03-07",
        ];
        $ot = OathTaking::where([['venue', 'UpdateTestVenueOne'], ['oath_date', '2023-04-07']])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/oathtaking/' . $ot->id);
        $response = $this->assertDatabaseMissing('oath_takings', $oathTakingData);
    }
}
