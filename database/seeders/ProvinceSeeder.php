<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [            
            ['province_name' => 'Abra', 'province_code' => 'ABR'],
            ['province_name' => 'Apayao', 'province_code' => 'APY'],
            ['province_name' => 'Benguet', 'province_code' => 'BNG'],
            ['province_name' => 'Ifugao', 'province_code' => 'IFG'],
            ['province_name' => 'Kalinga', 'province_code' => 'KLG'],
            ['province_name' => 'Mountain Province', 'province_code' => 'MTP'],
            
        ];
        foreach ($provinces as $municipality) {
            Province::create([
                // 'province_id' => $municipality['province_id'],
                'province_name' => $municipality['province_name'],
                'province_code' => $municipality['province_code'],
            ]);
        }
    }
}
