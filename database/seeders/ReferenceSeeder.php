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
                'telephone_number' => '09878837887',
                'name2' => 'Chris Bacon', 
                'address2' => 'La Trinidad', 
                'telephone_number2' => '09878837887',
                'name3' => 'Ben Jamin', 
                'address3' => 'Tuba', 
                'telephone_number3' => '09878837887'
            ],

            [
                'personal_data_sheet_id' => 2, 
                'name' => 'Lapt Top', 
                'address' => 'Sa Puso Mo', 
                'telephone_number' => '09000000000',
                'name2' => 'Acer Cer', 
                'address2' => 'Bokod', 
                'telephone_number2' => '09111111111',
                'name3' => 'Bob Bouy', 
                'address3' => 'Bakun', 
                'telephone_number3' => '09222222222'
            ],

            [
                'personal_data_sheet_id' => 3, 
                'name' => 'Kray Fisher', 
                'address' => 'Kay Alfi City', 
                'telephone_number' => '09333333333',
                'name2' => 'Lob Sterl', 
                'address2' => 'Ocean', 
                'telephone_number2' => '09444444444',
                'name3' => 'Kapz Noddle', 
                'address3' => 'La Trinidad', 
                'telephone_number3' => '09555555555'
            ],
            [
                'personal_data_sheet_id' => 4, 
                'name' => 'Apple Fone', 
                'address' => 'Baguio City', 
                'telephone_number' => '09666666666',
                'name2' => 'Bright Wall', 
                'address2' => 'La Trinidad', 
                'telephone_number2' => '09777777777',
                'name3' => 'Rock Brock', 
                'address3' => 'Buguias', 
                'telephone_number3' => '098888888888'
            ],
            [
                'personal_data_sheet_id' => 5, 
                'name' => 'Grey Anat', 
                'address' => 'Baguio City', 
                'telephone_number' => '09121212122',
                'name2' => 'Jhin Four', 
                'address2' => 'La Trinidad', 
                'telephone_number2' => '09454545455',
                'name3' => 'Pay Ger', 
                'address3' => 'Baguio City', 
                'telephone_number3' => '09676767676'
            ],
        ];

        foreach($references as $reference){
            Reference::create([
                'personal_data_sheet_id' => $reference['personal_data_sheet_id'],
                'name' => $reference['name'],
                'address' => $reference['address'],
                'telephone_number' => $reference['telephone_number'],
                
                'name2' => $reference['name2'],
                'address2' => $reference['address2'],
                'telephone_number2' => $reference['telephone_number2'],

                'name3'  => $reference['name3'],
                'address3' => $reference['address3'],
                'telephone_number3' => $reference['telephone_number3'],
            ]);
        }
    }
}
