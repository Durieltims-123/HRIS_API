<?php

namespace Database\Seeders;

use App\Models\Plantilla;
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
        $plantillas = Plantilla::all();

        PositionDescription::create(['plantilla_id' => $plantillas->random()->id, 'description' => 'luminous peria jaau jorian']);
        PositionDescription::create(['plantilla_id' => $plantillas->random()->id, 'description' => 'Quiu Joae poeol jorian']);
    }
}
