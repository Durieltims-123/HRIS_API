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
            'height' => $this->faker->randomElement(['1.5', '2']),
            'weight' => $this->faker->randomElement(['34', '55', '60']),
            'citizenship' => 'Filipino',
            'citizenship_type' => $this->faker->randomElement(['By Birth', 'By Naturalization']),
            'country' => $this->faker->country(),
            'blood_type' => $this->faker->randomElement(['O+', 'O-', 'AB', 'B']),
            'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Widowed']),
            'tin' => $this->faker->unique()->numerify('############'),
            'gsis' => $this->faker->unique()->numerify('############'),
            'pagibig' => $this->faker->unique()->numerify('############'),
            'philhealth' => $this->faker->unique()->numerify('############'),
            'sss' => $this->faker->unique()->numerify('############'),
            'residential_province' => "BENGUET",
            'residential_municipality' => "KAPANGAN",
            'residential_barangay' => "Sagubo",
            'residential_house' => $this->faker->randomNumber(),
            'residential_subdivision' => $this->faker->streetName(),
            'residential_street' => $this->faker->streetName(),
            'residential_zipcode' => $this->faker->numerify('####'),
            'permanent_province' => "BENGUET",
            'permanent_municipality' => "KAPANGAN",
            'permanent_barangay' => "Sagubo",
            'permanent_house' => $this->faker->randomNumber(),
            'permanent_subdivision' => $this->faker->streetName(),
            'permanent_street' => $this->faker->streetName(),
            'permanent_zipcode' => $this->faker->numerify('####'),
            'mobile_number' => $this->faker->numerify('09#########'),
            'telephone' => $this->faker->phoneNumber(),
            'email_address' => $this->faker->email(),
        ];
    }
}
