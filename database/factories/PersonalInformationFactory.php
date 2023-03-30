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
        $provinces = Province::all();
        $number = 1;
        return [
            'personal_data_sheet_id' => $number++,
            'mobile_number' => $this->faker->phoneNumber(),
            'telephone_number' => $this->faker->tollFreePhoneNumber(),
            'permanent_house_number' => $this->faker->number(),
            'permanent_subdivision_village'=> $this->faker->unique()->text(3),
            'permanent_street' => $this->faker->unique()->text(1),
            'barangay_id' => $this->faker->randomElement(['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18']),
            'municipality_id' => $this->faker->randomElement(['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18']),
            'province_id' => $this->faker->randomElement(['1','2','3','4','5','6']),
            'permanent_zip_code' => $this->faker->unique()->number(),
            'residential_house_number' => $this->faker->unique()->number(),
            'residential_subdivision_village' => $this->faker->unique()->text(3),
            'residential_street' => $this->faker->unique()->text(3),
            'r_barangay' => $this->faker->unique()->text(1),
            'r_municipality_id' => $this->faker->randomElement(['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18']),
            'r_province' => $this->faker->unique()->text(1),
            'residential_zip_code' => $this->faker->unique()->text(4),
            'citizenship' => 'Filipino',
            'agency_employee' => 'Employee Agency',
            'tin_number' => $this->faker->unique()->number(3),
            'sss_number' => $this->faker->unique()->number(3),
            'philhealth_number' => $this->faker->unique()->number(3),
            'pag_ibig_number' => $this->faker->unique()->number(3),
            'gsis_number' => $this->faker->unique()->number(3),
            'blood_type' =>$this->faker->randomElement(['O+','O-','AB','B']),
            'weight' => $this->faker->unique()->number(3),
            'height' => $this->faker->unique()->number(3),
            'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Widowed']),
            'sex' => $this->faker->randomElement(['Female', 'Male']),
            'birthplace'=> $this->faker->unique()->text(1),
            'birthdate' => $this->faker->date(),


        ];
    }
}
