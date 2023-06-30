<?php

namespace Database\Seeders;

use App\Models\LguPosition;
use App\Models\PositionDescription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lgu_positions = LguPosition::all();

        PositionDescription::create(['lgu_position_id' => $lgu_positions->random()->id, 'description' => 'luminous peria jaau jorian']);
        PositionDescription::create(['lgu_position_id' => $lgu_positions->random()->id, 'description' => 'Quiu Joae poeol jorian']);
    }
}
