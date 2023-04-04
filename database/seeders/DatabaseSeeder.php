<?php

namespace Database\Seeders;

use App\Models\Holiday;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Question;
use App\Models\Applicant;
use App\Models\Reference;
use App\Models\Recognition;
use App\Models\SalaryGrade;
use App\Models\VoluntaryWork;
use App\Models\WorkExperience;
use Illuminate\Database\Seeder;
use App\Models\FamilyBackground;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PersonalDataSheet;
use App\Models\SpecialSkillHobby;
use Database\Seeders\AnswerSeeder;
use App\Models\ChildrenInformation;
use App\Models\PersonalInformation;
use App\Models\EducationalBackground;
use App\Models\MembershipAssociation;
use App\Models\QualificationStandard;
use Database\Seeders\PlantillaSeeder;
use App\Models\CivilServiceEligibility;
use App\Models\TrainingProgramAttended;

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
        //
        
        
        // Reference::factory(10)

        $this->call([
            DepartmentSeeder::class,
            OfficeSeeder::class,
            PlantillaSeeder::class,
            PositionDescriptionSeeder::class,
            ProvinceSeeder::class,
            MunicipalitySeeder::class,
            BarangaySeeder::class,
            QuestionSeeder::class,
        ]);

        Employee::factory(5)->create();
        Applicant::factory(5)->create();
        $this->call([
            PersonalDataSheetSeeder::class,

        ]);

        
        // PersonalDataSheet::factory(5)->create();
        PersonalInformation::factory(5)->create();
        FamilyBackground::factory(5)->create();
        ChildrenInformation::factory(5)->create();
        EducationalBackground::factory(10)->create();
        CivilServiceEligibility::factory(5)->create();
        WorkExperience::factory(20)->create();
        VoluntaryWork::factory(20)->create();
        TrainingProgramAttended::factory(20)->create();
        SpecialSkillHobby::factory(20)->create();
        Recognition ::factory(20)->create();
        MembershipAssociation::factory(20)->create();

        $this->call([
            ReferenceSeeder::class,
            AnswerSeeder::class
        ]);
    }
}
