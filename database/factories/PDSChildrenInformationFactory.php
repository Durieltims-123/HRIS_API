<?php

namespace Database\Factories;

use App\Models\PDSFamilyBackground;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChildrenInformation>
 */
class PDSChildrenInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fams = PDSFamilyBackground::all();
        static $number = 1;
        static $num = 1;
        return [
            'personal_data_sheet_id' => $number++,
            'pds_family_background_id' =>  $num++,
            'name' => $this->faker->name(),
            'birthday' => $this->faker->date('Y-m-d')
        ];
    }
}
