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
        static $number = 1;
        return [
            'personal_data_sheet_id' => $number++,
            'birth_place' => $this->faker->city(),
            'birth_date' => $this->faker->date('Y-m-d'),
            'age' => $this->faker->randomNumber(),
            'sex' => $this->faker->randomElement(['Female', 'Male']),
            'height' => $this->faker->randomNumber(),
            'weight' => $this->faker->randomNumber(),
            'citizenship' => 'Filipino',
            'citizenship_type' => $this->faker->randomElement(['By Birth', 'By Naturalization']),
            'country' => $this->faker->country(),
            'blood_type' => $this->faker->randomElement(['O+', 'O-', 'AB', 'B']),
            'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Widowed']),
            'tin' => $this->faker->unique()->randomNumber(),
            'gsis' => $this->faker->unique()->randomNumber(),
            'pagibig' => $this->faker->unique()->randomNumber(),
            'philhealth' => $this->faker->unique()->randomNumber(),
            'sss' => $this->faker->unique()->randomNumber(),
            'residential_province' => $this->faker->text(),
            'residential_municipality' => $this->faker->text(),
            'residential_barangay' => $this->faker->text(),
            'residential_house' => $this->faker->randomNumber(),
            'residential_subdivision' => $this->faker->streetName(),
            'residential_street' => $this->faker->streetName(),
            'residential_zipcode' => $this->faker->randomNumber(),
            'permanent_province' => $this->faker->text(),
            'permanent_municipality' => $this->faker->text(),
            'permanent_barangay' => $this->faker->text(),
            'permanent_house' => $this->faker->randomNumber(),
            'permanent_subdivision' => $this->faker->streetName(),
            'permanent_street' => $this->faker->streetName(),
            'permanent_zipcode' => $this->faker->randomNumber(),
            'mobile_number' => $this->faker->phoneNumber(),
            'telephone' => $this->faker->phoneNumber(),
            'email_address' => $this->faker->email(),
        ];
    }
}
