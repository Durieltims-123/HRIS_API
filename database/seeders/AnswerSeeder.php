<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $answers = [
            [
                'personal_data_sheet_id'=>1, 
                'question_id'=> 1,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=> 'Pending'
            ],
            [
                'personal_data_sheet_id'=>1, 
                'question_id'=>2,
                'choice'=>'No',
                'details'=>Null, 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>1, 
                'question_id'=>3,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>1, 
                'question_id'=>4,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>1, 
                'question_id'=>5,
                'choice'=>'No',
                'details'=> Null, 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>1, 
                'question_id'=>6,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>1, 
                'question_id'=>7,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>1, 
                'question_id'=>8,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>1, 
                'question_id'=>9,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>1, 
                'question_id'=>10,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>1, 
                'question_id'=>11,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>1, 
                'question_id'=>12,
                'choice'=>'lorem',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            //
            [
                'personal_data_sheet_id'=>2, 
                'question_id'=> 1,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=> 'Pending'
            ],
            [
                'personal_data_sheet_id'=>2, 
                'question_id'=>2,
                'choice'=>'No',
                'details'=>Null, 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>2, 
                'question_id'=>3,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>2, 
                'question_id'=>4,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>2, 
                'question_id'=>5,
                'choice'=>'No',
                'details'=> Null, 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>2, 
                'question_id'=>6,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>2, 
                'question_id'=>7,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>2, 
                'question_id'=>8,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>2, 
                'question_id'=>9,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>2, 
                'question_id'=>10,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>2, 
                'question_id'=>11,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>2, 
                'question_id'=>12,
                'choice'=>'lorem',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            //
            [
                'personal_data_sheet_id'=>3, 
                'question_id'=> 1,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=> 'Pending'
            ],
            [
                'personal_data_sheet_id'=>3, 
                'question_id'=>2,
                'choice'=>'No',
                'details'=>Null, 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>3, 
                'question_id'=>3,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>3, 
                'question_id'=>4,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>3, 
                'question_id'=>5,
                'choice'=>'No',
                'details'=> Null, 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>3, 
                'question_id'=>6,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>3, 
                'question_id'=>7,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>3, 
                'question_id'=>8,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>3, 
                'question_id'=>9,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>3, 
                'question_id'=>10,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>3, 
                'question_id'=>11,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>3, 
                'question_id'=>12,
                'choice'=>'lorem',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            //
            [
                'personal_data_sheet_id'=>4, 
                'question_id'=> 1,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=> 'Pending'
            ],
            [
                'personal_data_sheet_id'=>4, 
                'question_id'=>2,
                'choice'=>'No',
                'details'=>Null, 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>4, 
                'question_id'=>3,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>4, 
                'question_id'=>4,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>4, 
                'question_id'=>5,
                'choice'=>'No',
                'details'=> Null, 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>4, 
                'question_id'=>6,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>4, 
                'question_id'=>7,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>4, 
                'question_id'=>8,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>4, 
                'question_id'=>9,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>4, 
                'question_id'=>10,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>4, 
                'question_id'=>11,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>4, 
                'question_id'=>12,
                'choice'=>'lorem',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            //
            [
                'personal_data_sheet_id'=>5, 
                'question_id'=> 1,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=> 'Pending'
            ],
            [
                'personal_data_sheet_id'=>5, 
                'question_id'=>2,
                'choice'=>'No',
                'details'=>Null, 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>5, 
                'question_id'=>3,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>5, 
                'question_id'=>4,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>5, 
                'question_id'=>5,
                'choice'=>'No',
                'details'=> Null, 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>5, 
                'question_id'=>6,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>5, 
                'question_id'=>7,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>5, 
                'question_id'=>8,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>5, 
                'question_id'=>9,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>5, 
                'question_id'=>10,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>5, 
                'question_id'=>11,
                'choice'=>'Yes',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
            [
                'personal_data_sheet_id'=>5, 
                'question_id'=>12,
                'choice'=>'lorem',
                'details'=>'lorem', 
                'date_filed' => 2023-03-03, 
                'case_status'=>'Pending' 
            ],
        ];

        foreach($answers as $answer){
            Answer::create([
                'personal_data_sheet_id' => $answer['personal_data_sheet_id'],
                'question_id' => $answer['question_id'],
                'choice' => $answer['choice'],
                'details' => $answer['details'],
                'date_filed' => $answer['date_filed'],
                'case_status' => $answer['case_status']
            ]);
        }
    }
}
