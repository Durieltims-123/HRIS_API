<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ReportOfAppointment;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportOfAppointmentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_report_of_appointment(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // index
    public function test_report_of_appointment_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/report-of-appointment');
        $response->assertStatus(200);
    }

    // add
    public function test_add_report_of_appointment(): void
    {
        $formData = [
            "reports" => "TestReport",
            "report_date" => "2023-03-05",
            "appointment_id" => ['1','2'],
        
        ];
        $reportOfAppointmentData = [
            "reports" => "TestReport",
            "report_date" => "2023-03-05",
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/report-of-appointment', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('report_of_appointments', $reportOfAppointmentData);
    }

    // edit 
    public function test_edit_report_of_appointment(): void
    {
        $formData = [
            "reports" => "UpdateTestReport",
            "report_date" => "2023-03-05",
            "appointment_id" => ['1','2'],
        
        ];
        $ReportOfAppointmentData = [
            "reports" => "UpdateTestReport",
            "report_date" => "2023-03-05",
        ];
        $roa = ReportOfAppointment::where([['reports','TestReport'],['report_date','2023-03-05']])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/report-of-appointment/' . $roa->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('report_of_appointments', $ReportOfAppointmentData);
    }

    // delete 
    public function test_delete_report_of_appointment(): void
    {
        $ReportOfAppointmentData = [
            "reports" => "UpdateTestReport",
            "report_date" => "2023-03-05",
            'deleted_at' => null
        ];
        $roa = ReportOfAppointment::where([['reports','UpdateTestReport'],['report_date','2023-03-05']])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/report-of-appointment/' . $roa->id);
        $response = $this->assertDatabaseMissing('report_of_appointments', $ReportOfAppointmentData);
    }
}
