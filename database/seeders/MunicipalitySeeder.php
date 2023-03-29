<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipalities = [            
            [ 'province_id' => 1, 'municipality_name' => 'Bangued', 'municipality_code' => 'BGD'],
            [ 'province_id' => 1, 'municipality_name' => 'Boliney', 'municipality_code' => 'BLY'],
            [ 'province_id' => 1, 'municipality_name' => 'Bucay', 'municipality_code' => 'BCY'],

            [ 'province_id' => 2, 'municipality_name' => 'Calanasan', 'municipality_code' => 'CLS'],
            [ 'province_id' => 2, 'municipality_name' => 'Conner', 'municipality_code' => 'CNR'],
            [ 'province_id' => 2, 'municipality_name' => 'Flora', 'municipality_code' => 'FLR'],

            [ 'province_id' => 3, 'municipality_name' => 'Atok', 'municipality_code' => 'ATK'],
            [ 'province_id' => 3, 'municipality_name' => 'Bakun', 'municipality_code' => 'BKN'],
            [ 'province_id' => 3, 'municipality_name' => 'Bokod', 'municipality_code' => 'BKD'],

            [ 'province_id' => 4, 'municipality_name' => 'Asipulo', 'municipality_code' => 'APO'],
            [ 'province_id' => 4, 'municipality_name' => 'Banaue', 'municipality_code' => 'BNE'],
            [ 'province_id' => 4, 'municipality_name' => 'Hingyon', 'municipality_code' => 'HGN'],

            [ 'province_id' => 5, 'municipality_name' => 'Balbalan', 'municipality_code' => 'BLN'],
            [ 'province_id' => 5, 'municipality_name' => 'Lubuagan', 'municipality_code' => 'LBG'],
            [ 'province_id' => 5, 'municipality_name' => 'Pasil', 'municipality_code' => 'PSL'],

            [ 'province_id' => 6, 'municipality_name' => 'Barlig', 'municipality_code' => 'BLG'],
            [ 'province_id' => 6, 'municipality_name' => 'Bauko', 'municipality_code' => 'BKO'],
            [ 'province_id' => 6, 'municipality_name' => 'Besao', 'municipality_code' => 'BSO'],
        ];
        // Insert the municipalities into the database
        foreach ($municipalities as $municipality) {
            Municipality::create([
                // 'municipality_id' => $municipality['municipality_id'],
                'province_id' => $municipality['province_id'],
                'municipality_name' => $municipality['municipality_name'],
                'municipality_code' => $municipality['municipality_code'],
            ]);
        }
    }
}
