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
                'individual_id' => 1,
                'individual_type' => "applicant",
            ],
            [
                'individual_id' => 2,
                'individual_type' => "applicant",
            ],
            [
                'individual_id' => 3,
                'individual_type' => "employee",
            ],
            [
                'individual_id' => 4,
                'individual_type' => "employee",
            ],
            [
                'individual_id' => 3,
                'individual_type' => "applicant",
            ],
        ];

        foreach ($personalDataSheets as $personalDataSheet) {
            PersonalDataSheet::create([
                'individual_id' => $personalDataSheet['individual_id'],
                'individual_type' => $personalDataSheet['individual_type']
            ]);
        }
    }
}
