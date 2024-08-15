<?php

namespace Database\Seeders;

use App\Models\Holiday;
use App\Models\Vacancy;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Question;
use App\Models\Applicant;
use App\Models\Interview;
use App\Models\PsbMember;
use App\Models\Reference;
use App\Models\Assessment;
use App\Models\Application;
use App\Models\Appointment;
use App\Models\Publication;
use App\Models\Recognition;
use App\Models\SalaryGrade;
use App\Models\VoluntaryWork;
use App\Models\WorkExperience;
use Illuminate\Database\Seeder;
use App\Models\FamilyBackground;
use App\Models\PersonalDataSheet;
use App\Models\SpecialSkillHobby;
use Database\Seeders\AnswerSeeder;
use App\Models\ChildrenInformation;
use App\Models\PersonalInformation;
use App\Models\EducationalBackground;
use App\Models\MembershipAssociation;
use App\Models\QualificationStandard;
use Database\Seeders\LguPositionSeeder;
use App\Models\CivilServiceEligibility;
use App\Models\Disqualification;
use App\Models\LguPosition;
use App\Models\PersonnelSelectionBoard;
use App\Models\PsbPersonnel;
use App\Models\PublicationInterview;
use App\Models\TrainingProgramAttended;
use App\Models\User;
use App\Models\Venue;

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
        User::factory(100)->create();
        Holiday::factory(10)->create();
        Venue::factory(11)->create();

        // SalaryGrade::factory(33)->create();
        // Position::factory(33)->create();
        // QualificationStandard::factory(33)->create();
        $this->call([
            SalaryGradeSeeder::class,
            PositionSeeder::class,
        ]);

        PersonnelSelectionBoard::factory(5)
            ->has(PsbPersonnel::factory()->count(5))
            ->create();

        // Applicant::factory(5)->create();
        //


        // Reference::factory(10)

        $this->call([
            OfficeSeeder::class,
            DivisionSeeder::class,
            ProvinceSeeder::class,
            MunicipalitySeeder::class,
            BarangaySeeder::class,
            QuestionSeeder::class,
        ]);

        LguPosition::factory(11)->create();
        $this->call([PositionDescriptionSeeder::class]);
        Employee::factory(11)->create();
        Vacancy::factory(2)->create();
        Publication::factory(2)->create();
        // Applicant::factory(10)->create();
        // Application::factory(10)->create();
        // $this->call([
        //     PersonalDataSheetSeeder::class,
        // ]);
        // Assessment::factory(5)->create();
        // Interview::factory(5)
        //     ->has(PublicationInterview::factory()->count(5)) //I stopped here
        //     ->create();
        // Disqualification::factory(5)->create();
        // Appointment::factory(5)->create();

        PersonalDataSheet::factory(11)->create();
        PersonalInformation::factory(11)->create();
        FamilyBackground::factory(11)->create();
        ChildrenInformation::factory(11)->create();
        EducationalBackground::factory(11)->create();
        CivilServiceEligibility::factory(11)->create();
        WorkExperience::factory(11)->create();
        VoluntaryWork::factory(11)->create();
        TrainingProgramAttended::factory(11)->create();
        SpecialSkillHobby::factory(11)->create();
        Recognition::factory(11)->create();
        MembershipAssociation::factory(11)->create();
        Reference::factory(11)->create();

        $this->call([
            // ReferenceSeeder::class,
            // AnswerSeeder::class,
            UserSeeder::class,
            GovernorSeeder::class
        ]);
    }
}
