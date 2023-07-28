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
            ['office_code'=>'123', 'office_name'=>'PGO'],
            ['office_code'=>'456', 'office_name'=>'KJP'],
            ['office_code'=>'678', 'office_name'=>'OPL']
        ];
        
        foreach ($offices as $office) {
            Office::create($office);
            
        }

        // Office::create([
        //     ['office_code'=>'123', 'office_name'=>'PGO'],
        //     ['office_code'=>'456', 'office_name'=>'KJP'],
        //     ['office_code'=>'678', 'office_name'=>'OPL']
        // ]);

    }
}
