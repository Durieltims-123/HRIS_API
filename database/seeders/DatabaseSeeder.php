<?php

namespace Database\Seeders;

use App\Models\Holiday;
use App\Models\Position;
use App\Models\Applicant;
use App\Models\ChildrenInformation;
use App\Models\CivilServiceEligibility;
use App\Models\EducationalBackground;
use App\Models\Employee;
use App\Models\FamilyBackground;
use App\Models\MembershipAssociation;
use App\Models\PersonalDataSheet;
use App\Models\PersonalInformation;
use App\Models\SalaryGrade;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QualificationStandard;
use App\Models\Question;
use App\Models\Recognition;
use App\Models\Reference;
use App\Models\SpecialSkillHobby;
use App\Models\TrainingProgramAttended;
use App\Models\VoluntaryWork;
use App\Models\WorkExperience;
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
        // Applicant::factory(5)->create();
        
        
        // Reference::factory(10)

        $this->call([
            DepartmentSeeder::class,
            OfficeSeeder::class,
            PlantillaSeeder::class,
            PositionDescriptionSeeder::class,
            ProvinceSeeder::class,
            MunicipalitySeeder::class,
            BarangaySeeder::class,
            Question::class
        ]);

        Employee::factory(5)->create();
        PersonalDataSheet::factory(5)->create();
        PersonalInformation::factory(5)->create();
        FamilyBackground::factory(5)->create();
        ChildrenInformation::factory(5)->create();
        EducationalBackground::factory(10)->create();
        CivilServiceEligibility::factory(5)->create();
        WorkExperience::factory(10)->create();
        VoluntaryWork::factory(10)->create();
        TrainingProgramAttended::factory(10)->create();
        SpecialSkillHobby::factory(10)->create();
        Recognition ::factory(10)->create();
        MembershipAssociation::factory(10)->create();
    }
}
