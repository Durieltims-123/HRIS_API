<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\Division;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Division::create([
        //     'division_code' => '234', 'division_name' => 'ALPGO',
        //     'division_code' => '564', 'division_name' => 'KDDLD',
        //     'division_code' => '678', 'division_name' => 'RTYR',
        // ]);
        $fores = Office::all();

        Division::create(['office_id' => $fores->random()->id, 'division_code' => '234', 'division_name' => 'ALPGO']);
        Division::create(['office_id' => $fores->random()->id, 'division_code' => '564', 'division_name' => 'KDDLD']);
        Division::create(['office_id' => $fores->random()->id, 'division_code' => '678', 'division_name' => 'RTYR']);
        // foreach($fores as $fore){
        //     Division::create([
        //         ['office_id' => $fore, 'division_code' => '234', 'division_name' => 'ALPGO'],
        //         ['office_id' => $fore, 'division_code' => '564', 'division_name' => 'KDDLD'],
        //         ['office_id' => $fore, 'division_code' => '678', 'division_name' => 'RTYR'],
        //     ]);
        // }
        
    }
}
