<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'number' => '34a',
                'question' => 'Are you related by consanguinity or affinity to the appointing or recommending authority, or to the			
                            chief of bureau or division or to the person who has immediate supervision over you in the Division, 			
                            Bureau or Office where you will be apppointed,			
                            a. within the third degree?'
            ],
            [
                'number' => '34b',
                'question' => 'b. within the fourth degree (for Local Government Unit - Career Employees)?'
            ],
            [
                'number' => '35a',
                'question' => 'a. Have you ever been found guilty of any administrative offense?'
            ],
            [
                'number' => '35b',
                'question' => 'b. Have you been criminally charged before any court?'
            ],
            [
                'number' => '36',
                'question' => 'Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?'
            ],
            [
                'number' => '37',
                'question' => 'Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased out (abolition) in the public or private sector?'
            ],
            [
                'number' => '38a',
                'question' => 'a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?'
            ],
            [
                'number' => '38b',
                'question' => 'b. Have you resigned from the government service during the three (3)-month period before the last election to promote/actively campaign for a national or local candidate?'
            ],
            [
                'number' => '39',
                'question' => 'Have you acquired the status of an immigrant or permanent resident of another country?'
            ],
            [
                'number' => '40a',
                'question' => "Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:
                                a. Are you a member of any indigenous group?"
            ],
            [
                'number' => '40b',
                'question' => "Are you a person with disability?"
            ],
            [
                'number' => '40c',
                'question' => "Are you a solo parent?"
            ],
        ];

        foreach ($questions as $question) {
            Question::create([
                'number' => $question['number'],
                'question' => $question['question']
            ]);
        }
    }
}
