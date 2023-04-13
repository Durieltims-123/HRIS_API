<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\PersonnelSelectionBoard;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonnelSelectionBoardTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_personnel_selection_board(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    // index
    public function test_personnel_selection_board_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/personnel-selection-board');
        $response->assertStatus(200);
    }

    // add
    public function test_add_personnel_selection_board(): void
    {
        $formData = [
            "start_date" => "2023-03-05",
            "end_date" => "2023-03-05",
            "chairman" => "TestChairman",
            "position" => "TestPosition",
            "status" => "TestStatus",
            "member_name" => ['TestMemberOne','TestMemberTwo'],
            "member_position" => ['TestPositionOne','TestPositionTwo'],
            "employee_id" => [5,6]
        ];
        $personnelSelectionBoardData = [
            "start_date" => "2023-03-05",
            "end_date" => "2023-03-05",
            "chairman" => "TestChairman",
            "position" => "TestPosition",
            "status" => "TestStatus",
        ];
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post('/api/personnel-selection-board', $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas('personnel_selection_boards', $personnelSelectionBoardData);
    }

    // edit 
    public function test_edit_personnel_selection_board(): void
    {
        $formData = [
            "start_date" => "2023-03-05",
            "end_date" => "2023-03-05",
            "chairman" => "UpdateTestChairman",
            "position" => "UpdateTestPosition",
            "status" => "UpdateTestStatus",
            "member_name" => ['UpdateTestMemberOne','UpdateTestMemberTwo'],
            "member_position" => ['UpdateTestPositionOne','UpdateTestPositionTwo'],
            "employee_id" => [5,6]
        ];
        $personnelSelectionBoardData = [
            "start_date" => "2023-03-05",
            "end_date" => "2023-03-05",
            "chairman" => "UpdateTestChairman",
            "position" => "UpdateTestPosition",
            "status" => "UpdateTestStatus",
        ];
        $psb = PersonnelSelectionBoard::where([['start_date','2023-03-05'],['chairman','TestChairman']])->first();

        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->patch('/api/personnel-selection-board/' . $psb->id, $formData);

        // this check if it updated in the database 
        $response = $this->assertDatabaseHas('personnel_selection_boards', $personnelSelectionBoardData);
    }

    // delete 
    public function test_delete_personnel_selection_board(): void
    {
        $personnelSelectionBoardData = [
            "start_date" => "2023-03-05",
            "end_date" => "2023-03-05",
            "chairman" => "UpdateTestChairman",
            "position" => "UpdateTestPosition",
            "status" => "UpdateTestStatus",
        ];
        $dept = PersonnelSelectionBoard::where([['start_date','2023-03-05'],['chairman','UpdateTestChairman']])->first();
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->delete('/api/personnel-selection-board/' . $dept->id);
        $response = $this->assertDatabaseMissing('personnel_selection_boards', $personnelSelectionBoardData);
    }
}
