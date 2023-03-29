<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Province::create(['province_name' => 'Benguet', 'province_code' => '1234']);
        Province::create(['province_name' => 'Kalinga', 'province_code' => '2345']);
        Province::create(['province_name' => 'Mt. Province', 'province_code' => '3456']);
        
    }
}
