<?php

namespace Database\Seeders;

use App\Models\PersonalDataSheet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalDataSheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $personalDataSheets = [
            [
                'applicant_id' => 1,
                'employee_id' => null,
            ],
            [
                'applicant_id' => 2,
                'employee_id' => null,
            ],
            [
                'applicant_id' => null,
                'employee_id' => 3,
            ],
            [
                'applicant_id' => null,
                'employee_id' => 4,
            ],
            [
                'applicant_id' => 3,
                'employee_id' => null,
            ],
        ];

        foreach($personalDataSheets as $personalDataSheet){
            PersonalDataSheet::create([
                'applicant_id' => $personalDataSheet['applicant_id'],
                'employee_id' => $personalDataSheet['employee_id']
            ]);
        }

    }
}
