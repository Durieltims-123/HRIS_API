<?php

namespace Tests\Feature;

use App\Models\ServiceRecordForm;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceRecordFormTest extends TestCase
{
    // link
    public function test_service_record_form_link(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // index
    public function test_service_record_form_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/service-record-form');
        $response->assertStatus(200);
    }

    // add
    public function test_add_service_record_form(): void
    {
        $formData = [
            'employee_id' => 1,
            'date_from' => "2020-10-10",
            'date_to' => "2020-10-10",
            'appointment_records' => "yahoo",
            'leave_without_pay' => "yahoo",
            'remarks' => "yahoo",
            'civil_status' => "yahoo",
            'designation' => "yahoo",
            'salary_annum' => "yahoo",
            'division_office' => "yahoo",
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/service-record-form', $formData); 

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('service_record_forms', $formData);
    }



    // edit 
    public function test_edit_service_record_form(): void
    {
        $formData = [
            'employee_id' => 1,
            'date_from' => "2020-10-10",
            'date_to' => "2020-10-10",
            'appointment_records' => "yahoo 2 3",
            'leave_without_pay' => "yahoo",
            'remarks' => "yahoo",
            'civil_status' => "yahoo",
            'designation' => "yahoo",
            'salary_annum' => "yahoo",
            'division_office' => "yahoo",
        ];
        $sg = ServiceRecordForm::where([["employee_id", 1], ["appointment_records", "yahoo"]])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/service-record-form/' . $sg->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('service_record_forms', $formData);
    }

    // delete 
    public function test_delete_service_record_form(): void
    {
        $formData = [
            'employee_id' => 1,
            'date_from' => "2020-10-10",
            'date_to' => "2020-10-10",
            'appointment_records' => "yahoo 2 3",
            'leave_without_pay' => "yahoo",
            'remarks' => "yahoo",
            'civil_status' => "yahoo",
            'designation' => "yahoo",
            'salary_annum' => "yahoo",
            'division_office' => "yahoo",
            'deleted_at' => null
        ];
        $sg = ServiceRecordForm::where([["employee_id", 1], ["appointment_records", "yahoo 2 3"]])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/service-record-form/' . $sg->id);
        $response = $this->assertDatabaseMissing('service_record_forms', $formData);
    }
}
