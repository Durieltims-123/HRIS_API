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
use App\Models\Assessment;
use App\Models\Application;
use App\Models\Appointment;
use App\Models\Publication;
use App\Models\SalaryGrade;
use Illuminate\Database\Seeder;
use App\Models\PersonalDataSheet;
use App\Models\QualificationStandard;
use Database\Seeders\LguPositionSeeder;
use App\Models\Disqualification;
use App\Models\LguPosition;
use App\Models\PersonnelSelectionBoard;
use App\Models\PsbPersonnel;
use App\Models\PublicationInterview;
use App\Models\User;
use App\Models\Venue;
use App\Models\PDSReference;
use App\Models\PDSRecognition;
use App\Models\PDSVoluntaryWork;
use App\Models\PDSWorkExperience;
use App\Models\PDSFamilyBackground;
use App\Models\PDSSpecialSkillHobby;
use Database\Seeders\PDSAnswerSeeder;
use App\Models\PDSChildrenInformation;
use App\Models\PDSPersonalInformation;
use App\Models\PDSEducationalBackground;
use App\Models\PDSMembershipAssociation;
use App\Models\PDSCivilServiceEligibility;
use App\Models\PDSTrainingProgramAttended;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            SalaryGradeSeeder::class,
            PositionSeeder::class,
            OfficeSeeder::class,
            DivisionSeeder::class,
        ]);

        LguPosition::factory(11)->create();
        $this->call([PositionDescriptionSeeder::class]);
        Employee::factory(11)->create();
        // Vacancy::factory(2)->create();
        // Publication::factory(2)->create();
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
        PDSPersonalInformation::factory(11)->create();
        PDSFamilyBackground::factory(11)->create();
        PDSChildrenInformation::factory(11)->create();
        PDSEducationalBackground::factory(11)->create();
        PDSCivilServiceEligibility::factory(11)->create();
        PDSWorkExperience::factory(11)->create();
        PDSVoluntaryWork::factory(11)->create();
        PDSTrainingProgramAttended::factory(11)->create();
        PDSSpecialSkillHobby::factory(11)->create();
        PDSRecognition::factory(11)->create();
        PDSMembershipAssociation::factory(11)->create();
        PDSReference::factory(11)->create();

        $this->call([
            // ReferenceSeeder::class,
            // AnswerSeeder::class,
            UserSeeder::class,
            GovernorSeeder::class
        ]);
    }
}
