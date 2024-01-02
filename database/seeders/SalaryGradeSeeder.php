<?php

namespace Database\Seeders;

use App\Models\SalaryGrade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaryGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['number' => 1, 'amount' => 13000],
            ['number' => 2, 'amount' => 13819],
            ['number' => 3, 'amount' => 14678],
            ['number' => 4, 'amount' => 15586],
            ['number' => 5, 'amount' => 16543],
            ['number' => 6, 'amount' => 17553],
            ['number' => 7, 'amount' => 18620],
            ['number' => 8, 'amount' => 19744],
            ['number' => 9, 'amount' => 21129],
            ['number' => 10, 'amount' => 23176],
            ['number' => 11, 'amount' => 27000],
            ['number' => 12, 'amount' => 29165],
            ['number' => 13, 'amount' => 31320],
            ['number' => 14, 'amount' => 33843],
            ['number' => 15, 'amount' => 36619],
            ['number' => 16, 'amount' => 39672],
            ['number' => 17, 'amount' => 43030],
            ['number' => 18, 'amount' => 46725],
            ['number' => 19, 'amount' => 51357],
            ['number' => 20, 'amount' => 57347],
            ['number' => 21, 'amount' => 63997],
            ['number' => 22, 'amount' => 71511],
            ['number' => 23, 'amount' => 80003],
            ['number' => 24, 'amount' => 90078],
            ['number' => 25, 'amount' => 102690],
            ['number' => 26, 'amount' => 116040],
            ['number' => 27, 'amount' => 131124],
            ['number' => 28, 'amount' => 148171],
            ['number' => 29, 'amount' => 167432],
            ['number' => 30, 'amount' => 189199],
            ['number' => 31, 'amount' => 278434],
            ['number' => 32, 'amount' => 331954],
            ['number' => 33, 'amount' => 419144],

        ];
        foreach ($data as $row) {
            SalaryGrade::create(
                $row
            );
        }
    }
}
