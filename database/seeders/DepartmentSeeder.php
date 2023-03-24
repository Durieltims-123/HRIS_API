<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {

        $departments = [
            ['department_code'=>'123', 'department_name'=>'PGO'],
            ['department_code'=>'456', 'department_name'=>'KJP'],
            ['department_code'=>'678', 'department_name'=>'OPL']
        ];
        
        foreach ($departments as $department) {
            Department::create($department);
            
        }

        // Department::create([
        //     ['department_code'=>'123', 'department_name'=>'PGO'],
        //     ['department_code'=>'456', 'department_name'=>'KJP'],
        //     ['department_code'=>'678', 'department_name'=>'OPL']
        // ]);

    }
}
