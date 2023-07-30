<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {

        $offices = [
            ['office_code' => 'ADH', 'office_name' => "Atok District Hospital"],
            ['office_code' => 'BEGH', 'office_name' => "Benguet General Hospital Economic Enterprise"],
            ['office_code' => 'BPENRO', 'office_name' => "Benguet Provincial Environment & Natural Resources Office"],
            ['office_code' => 'DMDH', 'office_name' => "Dennis Medical District Hospital"],
            ['office_code' => 'IDH', 'office_name' => "Itogon District Hospital"],
            ['office_code' => 'KDH', 'office_name' => "Kapangan District Hospital"],
            ['office_code' => 'NBDH', 'office_name' => "Northern Benguet District Hospital"],
            ['office_code' => 'OPAG', 'office_name' => "Office of the Provincial Agriculturist"],
            ['office_code' => 'PACCO', 'office_name' => "Provincial Accounting Office"],
            ['office_code' => 'PASSO', 'office_name' => "Provincial Assessor's Office"],
            ['office_code' => 'PBO', 'office_name' => "Provincial Budget Office"],
            ['office_code' => 'PEO', 'office_name' => "Provincial Engineer's Office"],
            ['office_code' => 'PHRMDO', 'office_name' => "Provincial Human Resource Management & Development Office"],
            ['office_code' => 'PHO', 'office_name' => "Provincial Health Office"],
            ['office_code' => 'PGO', 'office_name' => "Provincial Governor's Office"],
            ['office_code' => 'PGSO', 'office_name' => "Provincial General Services Office"],
            ['office_code' => 'PLO', 'office_name' => "Provincial Legal Office"],
            ['office_code' => 'PPDO', 'office_name' => "Provincial Planning & Development Office"],
            ['office_code' => 'PSWDO', 'office_name' => "Provincial Social Welfare & Development Office"],
            ['office_code' => 'PTO', 'office_name' => "Provincial Treasury Office"],
            ['office_code' => 'PVET', 'office_name' => "Provincial Veterinary Office"],
            ['office_code' => 'SPO', 'office_name' => "Sangguniang Panlalawigan Office"],
            ['office_code' => 'VGO', 'office_name' => "Vice Governor's Office"]
        ];

        foreach ($offices as $office) {
            Office::create($office);
        }
    }
}
