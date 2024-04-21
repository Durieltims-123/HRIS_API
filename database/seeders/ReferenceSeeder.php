<?php

namespace Database\Seeders;

use App\Models\Reference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $references = [
            [
                'personal_data_sheet_id' => 1,
                'name' => 'John Maker',
                'address' => 'Baguio City',
                'number' => '09878837887',
                'name2' => 'Chris Bacon',
                'address2' => 'La Trinidad',
                'number2' => '09878837887',
                'name3' => 'Ben Jamin',
                'address3' => 'Tuba',
                'number3' => '09878837887'
            ],

            [
                'personal_data_sheet_id' => 2,
                'name' => 'Lapt Top',
                'address' => 'Sa Puso Mo',
                'number' => '09000000000',
                'name2' => 'Acer Cer',
                'address2' => 'Bokod',
                'number2' => '09111111111',
                'name3' => 'Bob Bouy',
                'address3' => 'Bakun',
                'number3' => '09222222222'
            ],

            [
                'personal_data_sheet_id' => 3,
                'name' => 'Kray Fisher',
                'address' => 'Kay Alfi City',
                'number' => '09333333333',
                'name2' => 'Lob Sterl',
                'address2' => 'Ocean',
                'number2' => '09444444444',
                'name3' => 'Kapz Noddle',
                'address3' => 'La Trinidad',
                'number3' => '09555555555'
            ],
            [
                'personal_data_sheet_id' => 4,
                'name' => 'Apple Fone',
                'address' => 'Baguio City',
                'number' => '09666666666',
                'name2' => 'Bright Wall',
                'address2' => 'La Trinidad',
                'number2' => '09777777777',
                'name3' => 'Rock Brock',
                'address3' => 'Buguias',
                'number3' => '098888888888'
            ],
            [
                'personal_data_sheet_id' => 5,
                'name' => 'Grey Anat',
                'address' => 'Baguio City',
                'number' => '09121212122',
                'name2' => 'Jhin Four',
                'address2' => 'La Trinidad',
                'number2' => '09454545455',
                'name3' => 'Pay Ger',
                'address3' => 'Baguio City',
                'number3' => '09676767676'
            ],
        ];

        foreach ($references as $reference) {
            Reference::create([
                'personal_data_sheet_id' => $reference['personal_data_sheet_id'],
                'name' => $reference['name'],
                'address' => $reference['address'],
                'number' => $reference['number']
            ]);

            Reference::create([
                'personal_data_sheet_id' => $reference['personal_data_sheet_id'],
                'name' => $reference['name2'],
                'address' => $reference['address2'],
                'number' => $reference['number2']
            ]);

            Reference::create([
                'personal_data_sheet_id' => $reference['personal_data_sheet_id'],
                'name'  => $reference['name3'],
                'address' => $reference['address3'],
                'number' => $reference['number3']
            ]);
        }
    }
}
