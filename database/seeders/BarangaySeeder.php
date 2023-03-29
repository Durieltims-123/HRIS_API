<?php

namespace Database\Seeders;

use App\Models\Barangay;
use App\Models\Municipality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangays = [            
            ['municipality_id' => '1', 'barangay_name' => 'Agtangao', 'barangay_code' => 'ABC'],
            ['municipality_id' => '1', 'barangay_name' => 'Angad', 'barangay_code' => 'ABC'],
            ['municipality_id' => '1', 'barangay_name' => 'Bañacao', 'barangay_code' => 'ABC'],

            ['municipality_id' => '2', 'barangay_name' => 'Amti', 'barangay_code' => 'ABC'],
            ['municipality_id' => '2', 'barangay_name' => 'Bao-yan', 'barangay_code' => 'ABC'],
            ['municipality_id' => '2', 'barangay_name' => 'Danac East', 'barangay_code' => 'ABC'],

            ['municipality_id' => '3', 'barangay_name' => 'Abang', 'barangay_code' => 'ABC'],
            ['municipality_id' => '3', 'barangay_name' => 'Bangbangcag', 'barangay_code' => 'ABC'],
            ['municipality_id' => '3', 'barangay_name' => 'Bangcagan', 'barangay_code' => 'ABC'],

            ['municipality_id' => '4', 'barangay_name' => 'Butao', 'barangay_code' => 'ABC'],
            ['municipality_id' => '4', 'barangay_name' => 'Cadaclan', 'barangay_code' => 'ABC'],
            ['municipality_id' => '4', 'barangay_name' => 'Don Roque Ablan Sr.', 'barangay_code' => 'ABC'],

            ['municipality_id' => '5', 'barangay_name' => 'Allangigan', 'barangay_code' => 'ABC'],
            ['municipality_id' => '5', 'barangay_name' => 'Banban', 'barangay_code' => 'ABC'],
            ['municipality_id' => '5', 'barangay_name' => 'Buluan', 'barangay_code' => 'ABC'],

            ['municipality_id' => '6', 'barangay_name' => 'Allig', 'barangay_code' => 'ABC'],
            ['municipality_id' => '6', 'barangay_name' => 'Anninipan', 'barangay_code' => 'ABC'],
            ['municipality_id' => '6', 'barangay_name' => 'Atok', 'barangay_code' => 'ABC'],

            ['municipality_id' => '7', 'barangay_name' => 'Abiang', 'barangay_code' => 'ABC'],
            ['municipality_id' => '7', 'barangay_name' => 'Caliking', 'barangay_code' => 'ABC'],
            ['municipality_id' => '7', 'barangay_name' => 'Cattubo', 'barangay_code' => 'ABC'],

            ['municipality_id' => '8', 'barangay_name' => 'Gambang', 'barangay_code' => 'ABC'],
            ['municipality_id' => '8', 'barangay_name' => 'Poblacion', 'barangay_code' => 'ABC'],
            ['municipality_id' => '8', 'barangay_name' => 'Dalipey', 'barangay_code' => 'ABC'],

            ['municipality_id' => '9', 'barangay_name' => 'Ambuclao', 'barangay_code' => 'ABC'],
            ['municipality_id' => '9', 'barangay_name' => 'Bila', 'barangay_code' => 'ABC'],
            ['municipality_id' => '9', 'barangay_name' => 'Daclan', 'barangay_code' => 'ABC'],
            
            ['municipality_id' => '10', 'barangay_name' => 'Amduntog', 'barangay_code' => 'ABC'],
            ['municipality_id' => '10', 'barangay_name' => 'Antipolo', 'barangay_code' => 'ABC'],
            ['municipality_id' => '10', 'barangay_name' => 'Camandag', 'barangay_code' => 'ABC'],

            ['municipality_id' => '11', 'barangay_name' => 'Amganad', 'barangay_code' => 'ABC'],
            ['municipality_id' => '11', 'barangay_name' => 'Anaba', 'barangay_code' => 'ABC'],
            ['municipality_id' => '11', 'barangay_name' => 'Balawis', 'barangay_code' => 'ABC'],

            ['municipality_id' => '12', 'barangay_name' => 'Anao', 'barangay_code' => 'ABC'],
            ['municipality_id' => '12', 'barangay_name' => 'Bangtinon', 'barangay_code' => 'ABC'],
            ['municipality_id' => '12', 'barangay_name' => 'Bitu', 'barangay_code' => 'ABC'],

            ['municipality_id' => '13', 'barangay_name' => 'Balantoy', 'barangay_code' => 'ABC'],
            ['municipality_id' => '13', 'barangay_name' => 'Balbalasang', 'barangay_code' => 'ABC'],
            ['municipality_id' => '13', 'barangay_name' => 'Buaya', 'barangay_code' => 'ABC'],

            ['municipality_id' => '14', 'barangay_name' => 'Dangoy', 'barangay_code' => 'ABC'],
            ['municipality_id' => '14', 'barangay_name' => 'Mabilong', 'barangay_code' => 'ABC'],
            ['municipality_id' => '14', 'barangay_name' => 'Mabongtot', 'barangay_code' => 'ABC'],

            ['municipality_id' => '15', 'barangay_name' => 'Ableg', 'barangay_code' => 'ABC'],
            ['municipality_id' => '15', 'barangay_name' => 'Bagtayan', 'barangay_code' => 'ABC'],
            ['municipality_id' => '15', 'barangay_name' => 'Balatoc', 'barangay_code' => 'ABC'],

            ['municipality_id' => '16', 'barangay_name' => 'Chupac', 'barangay_code' => 'ABC'],
            ['municipality_id' => '16', 'barangay_name' => 'Fiangtin', 'barangay_code' => 'ABC'],
            ['municipality_id' => '16', 'barangay_name' => 'Kaleo', 'barangay_code' => 'ABC'],

            ['municipality_id' => '17', 'barangay_name' => 'Abatan', 'barangay_code' => 'ABC'],
            ['municipality_id' => '17', 'barangay_name' => 'Balintaugan', 'barangay_code' => 'ABC'],
            ['municipality_id' => '17', 'barangay_name' => 'Banao', 'barangay_code' => 'ABC'],

            ['municipality_id' => '18', 'barangay_name' => 'Agawa', 'barangay_code' => 'ABC'],
            ['municipality_id' => '18', 'barangay_name' => 'Ambagiw', 'barangay_code' => 'ABC'],
            ['municipality_id' => '18', 'barangay_name' => 'Banguitan', 'barangay_code' => 'ABC'],
        ];
        foreach ($barangays as $barangay) {
            Barangay::create([
                // 'barangay_id' => $barangay['barangay_id'],
                'municipality_id' => $barangay['municipality_id'],
                'barangay_name' => $barangay['barangay_name'],
                'barangay_code' => $barangay['barangay_code'],
            ]);
        }
    }   
}
