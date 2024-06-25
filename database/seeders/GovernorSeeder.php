<?php

namespace Database\Seeders;

use App\Models\Governor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GovernorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Governor::create([
            "name" => "Melchor D. Diclas",
            "suffix" => "MD"
        ]);
    }
}
