<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Office;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Office::create([
        //     'office_code' => '234', 'office_name' => 'ALPGO',
        //     'office_code' => '564', 'office_name' => 'KDDLD',
        //     'office_code' => '678', 'office_name' => 'RTYR',
        // ]);
        $fores = Department::all();

        Office::create(['department_id' => $fores->random()->id, 'office_code' => '234', 'office_name' => 'ALPGO']);
        Office::create(['department_id' => $fores->random()->id, 'office_code' => '564', 'office_name' => 'KDDLD']);
        Office::create(['department_id' => $fores->random()->id, 'office_code' => '678', 'office_name' => 'RTYR']);
        // foreach($fores as $fore){
        //     Office::create([
        //         ['department_id' => $fore, 'office_code' => '234', 'office_name' => 'ALPGO'],
        //         ['department_id' => $fore, 'office_code' => '564', 'office_name' => 'KDDLD'],
        //         ['department_id' => $fore, 'office_code' => '678', 'office_name' => 'RTYR'],
        //     ]);
        // }
        
    }
}
