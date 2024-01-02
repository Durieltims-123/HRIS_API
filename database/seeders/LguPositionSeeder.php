<?php

namespace Database\Seeders;

use App\Models\LguPosition;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LguPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $positions = Position::all();

        LguPosition::create(['division_id' => '1', 'position_id' => $positions->random()->id, 'item_number' => '234', 'place_of_assignment' => 'IT Division', 'year' => '2023', 'position_status' => 'Permanent']);
        LguPosition::create(['division_id' => '2', 'position_id' => $positions->random()->id, 'item_number' => '564', 'place_of_assignment' => 'Accounting Division', 'year' => '2023', 'position_status' => 'Casual']);
       
    }
}
