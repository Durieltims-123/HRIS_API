<?php

namespace Database\Factories;

use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalInformation>
 */
class PersonalInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $provinces = Province::all();
        static $number = 1;
        return [
            'personal_data_sheet_id' => $number++,
            'mobile_number' => $this->faker->phoneNumber(),
            'telephone_number' => $this->faker->phoneNumber(),
            'permanent_house_number' => $this->faker->buildingNumber(),
            'permanent_subdivision_village'=> $this->faker->unique()->text(),
            'permanent_street' => $this->faker->streetName(),
            'barangay_id' => $this->faker->randomElement(['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18']),
            'municipality_id' => $this->faker->randomElement(['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18']),
            'province_id' => $this->faker->randomElement(['1','2','3','4','5','6']),
            'permanent_zip_code' => $this->faker->unique()->randomNumber(),
            'residential_house_number' => $this->faker->unique()->randomNumber(),
            'residential_subdivision_village' => $this->faker->unique()->text(),
            'residential_street' => $this->faker->unique()->streetName(),
            'r_barangay_id' => $this->faker->randomElement(['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18']),
            'r_municipality_id' => $this->faker->randomElement(['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18']),
            'r_province_id' => $this->faker->randomElement(['1','2','3','4','5','6']),
            'residential_zip_code' => $this->faker->randomNumber(),
            'citizenship' => 'Filipino',
            'agency_employee' => 'Employee Agency',
            'tin_number' => $this->faker->unique()->randomNumber(),
            'sss_number' => $this->faker->unique()->randomNumber(),
            'philhealth_number' => $this->faker->unique()->randomNumber(),
            'pag_ibig_number' => $this->faker->unique()->randomNumber(),
            'gsis_number' => $this->faker->unique()->randomNumber(),
            'blood_type' =>$this->faker->randomElement(['O+','O-','AB','B']),
            'weight' => $this->faker->unique()->randomNumber(),
            'height' => $this->faker->unique()->randomNumber(),
            'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Widowed']),
            'sex' => $this->faker->randomElement(['Female', 'Male']),
            'birthplace'=> $this->faker->city(),
            'birthdate' => $this->faker->date('Y-m-d'),


        ];
    }
}
