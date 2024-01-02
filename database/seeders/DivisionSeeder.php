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
        //     "division_code" => "234", "division_name" => "ALPGO",
        //     "division_code" => "564", "division_name" => "KDDLD",
        //     "division_code" => "678", "division_name" => "RTYR",
        // ]);
        $fores = Office::all();

        Division::create(["office_id" => 15, "division_code" => "   PGO-ADM", "division_name" => "Provincial Governor's Office - Administrative", "division_type" => "Division"]);
        Division::create(["office_id" => 15, "division_code" => "   PGO-BTS", "division_name" => "Provincial Governor's Office - Benguet Technical School", "division_type" => "Unit"]);
        Division::create(["office_id" => 15, "division_code" => "   PGO-ITS", "division_name" => "Provincial Governor's Office - Information Technology Services", "division_type" => "Unit"]);
        Division::create(["office_id" => 15, "division_code" => "   PGO-JAIL", "division_name" => "Provincial Warden's Office/Jail", "division_type" => "Unit"]);
        Division::create(["office_id" => 15, "division_code" => "   PGO-LIB", "division_name" => "Provincial Governor's Office - Library", "division_type" => "Section"]);
        Division::create(["office_id" => 15, "division_code" => "   PGO-MAIN", "division_name" => "Provincial Governor's Office - Main", "division_type" => "Division"]);
        Division::create(["office_id" => 15, "division_code" => "   PGO-PDRRMO", "division_name" => "Provincial Disaster Risk Reduction & Management Office", "division_type" => "Division"]);
        Division::create(["office_id" => 15, "division_code" => "   PGO-REC", "division_name" => "Provincial Governor's Office - Records", "division_type" => "Unit"]);
        Division::create(["office_id" => 15, "division_code" => "   PGO-SPL", "division_name" => "Provincial Governor's Office - Special Services", "division_type" => "Unit"]);
        Division::create(["office_id" => 15, "division_code" => "   PGO-TOUR", "division_name" => "Provincial Governor's Office - Tourism", "division_type" => "Division"]);
        // foreach($fores as $fore){
        //     Division::create([
        //         ["office_id" => $fore, "division_code" => "234", "division_name" => "ALPGO"],
        //         ["office_id" => $fore, "division_code" => "564", "division_name" => "KDDLD"],
        //         ["office_id" => $fore, "division_code" => "678", "division_name" => "RTYR"],
        //     ]);
        // }

    }
}
