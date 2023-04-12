<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\SalaryGrade;
use App\Models\User;
use Tests\TestCase;

class SalaryGradeTest extends TestCase
{
    // link
    public function test_salary_grade_link(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // index
    public function test_salary_grade_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/salary-grade');
        $response->assertStatus(200);
    }

    // add
    public function test_add_salary_grade(): void
    {
        $formData = [
            "number" => "100",
            "amount" => 1.23
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/salary-grade', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('salary_grades', $formData);
    }



    // edit 
    public function test_edit_salary_grade(): void
    {
        $formData = [
            "number" => "100",
            "amount" => 2.34
        ];
        $sg = SalaryGrade::where([["number", "100"], ["amount", 1.23]])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/salary-grade/' . $sg->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('salary_grades', $formData);
    }

    // delete 
    public function test_delete_salary_grade(): void
    {
        $formData = [
            "number" => "100",
            "amount" => 2.34
        ];
        $sg = SalaryGrade::where([["number", "100"], ["amount", 2.34]])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/salary-grade/' . $sg->id);
        $response = $this->assertDatabaseMissing('salary_grades', $formData);
    }
}
