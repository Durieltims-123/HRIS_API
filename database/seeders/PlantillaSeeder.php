<?php

namespace Database\Seeders;

use App\Models\Plantilla;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlantillaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $positions = Position::all();

        Plantilla::create(['office_id' => '1', 'position_id' => $positions->random()->id, 'item_number' => '234', 'place_of_assignment' => 'IT Office', 'year' => '2023']);
        Plantilla::create(['office_id' => '2', 'position_id' => $positions->random()->id, 'item_number' => '564', 'place_of_assignment' => 'Accounting Office', 'year' => '2023']);
       
    }
}
