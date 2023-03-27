<?php

namespace Database\Seeders;

use App\Models\Holiday;
use App\Models\Position;
use App\Models\SalaryGrade;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\QualificationStandard;
use Database\Seeders\PlantillaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Holiday::factory(10)->create();
        SalaryGrade::factory(33)->create();
        Position::factory(33)->create();
        QualificationStandard::factory(33)->create();
        
        $this->call([
            DepartmentSeeder::class,
            OfficeSeeder::class,
            PlantillaSeeder::class,
            PositionDescriptionSeeder::class
        ]);
    }
}
