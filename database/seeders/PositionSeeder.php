<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\Province;
use Illuminate\Database\Seeder;
use App\Models\QualificationStandard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                "code" => "***",
                "title" => "Accountant I",
                "salary_grade_id" => 12,
                "education" => "BS Accountancy, BS Commerce or Business Administration major in Accounting",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "RA 1080 (Accountant)"
            ],
            [
                "code" => "***",
                "title" => "Accountant II",
                "salary_grade_id" => 16,
                "education" => "BS Accountancy, BS Commerce or Business Administration major in Accounting",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080 (Accountant)"
            ],
            [
                "code" => "***",
                "title" => "Accountant III",
                "salary_grade_id" => 19,
                "education" => "BS Accountancy, BS Commerce or Business Administration major in Accounting",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "RA 1080 (Accountant)"
            ],
            [
                "code" => "***",
                "title" => "Accountant IV",
                "salary_grade_id" => 22,
                "education" => "BS Accountancy, BS Commerce or Business Administration major in Accounting",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "RA 1080 (Accountant)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide I (Utility Worker I)",
                "salary_grade_id" => 1,
                "education" => "Must be able to read and write",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide II (Messenger)",
                "salary_grade_id" => 2,
                "education" => "Elementary School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide III (Utility Worker II)",
                "salary_grade_id" => 3,
                "education" => "Elementary  School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide III (Plumber I)",
                "salary_grade_id" => 3,
                "education" => "Elementary  School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Relevant CSC MC 11, series of 1996"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide III (Driver I)",
                "salary_grade_id" => 3,
                "education" => "High School Graduate or Completion of the Required Vocational/Trade Course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Driver's License"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide III (Clerk I)",
                "salary_grade_id" => 3,
                "education" => "Completion of two years studies in college",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide IV (Clerk II)",
                "salary_grade_id" => 4,
                "education" => "Completion of two years studies in college",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide IV (Driver II)",
                "salary_grade_id" => 4,
                "education" => "High School Graduate or Completion of the Required Vocational/Trade Course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Driver's License"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide IV (Mechanical Plant Operator I)",
                "salary_grade_id" => 4,
                "education" => "High School Graduate or Completion of the Required Vocational/Trade Course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide V (Audio-Visual)",
                "salary_grade_id" => 5,
                "education" => "High School Graduate or Completion of the Required Vocational/Trade Course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Audio-Visual Equipment Operator Eligibility) (CSC MC 11, s 1996 Cat. II)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide V (Eqiupment Operator I)",
                "salary_grade_id" => 5,
                "education" => "High School Graduate or Completion of the Required Vocational/Trade Course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Audio-Visual Equipment Operator Eligibility) (CSC MC 11, s 1996 Cat. II)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide V (Carpernter II)",
                "salary_grade_id" => 5,
                "education" => "High School Graduate or Completion of the Required Vocational/Trade Course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Carpenter (CSC MC 11, S1996 Cat II)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide V (Chauffeur I)",
                "salary_grade_id" => 5,
                "education" => "High School Graduate or Completion of the Required Vocational/Trade Course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Driver's License"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide VI (Clerk II)",
                "salary_grade_id" => 6,
                "education" => "Completion of two years study in college",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide VI (Communication Equipment Operator II)",
                "salary_grade_id" => 6,
                "education" => "High School Graduate or Completion of the Required Vocational/Trade Course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Appropriate License (CSC MC 11, s. 1996 Cat II)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide VI (Mechanic II)",
                "salary_grade_id" => 6,
                "education" => "High School Graduate or Completion of the Required Vocational/Trade Course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Mechanic (CSC MC 11, s. 1996 Cat II)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide VI (Electrician II)",
                "salary_grade_id" => 6,
                "education" => "High School Graduate or Completion of the Required Vocational/Trade Course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Electrician (CSC MC 11, s. 1996 Cat II)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Aide VI (Labor Foreman)",
                "salary_grade_id" => 6,
                "education" => "High School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Administrative Assistant I (Computer Operator I)",
                "salary_grade_id" => 7,
                "education" => "Completion of two years study in college",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Assistant I (Audio-Visual Equipment Operator III)",
                "salary_grade_id" => 7,
                "education" => "Completion of two years studies in college",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "Audio-Visual Equipment Operator Eligibility (CSC MC 11, s 1996 Cat. II)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Assistant II (Budgeting Assistant)",
                "salary_grade_id" => 8,
                "education" => "Completion of two years studies in collegestudies on college",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Assistant II (Management and Audit Assistant)",
                "salary_grade_id" => 8,
                "education" => "Completion of two years studies in collegestudies on college",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Assistant II (Human Resource Management Assistant)",
                "salary_grade_id" => 8,
                "education" => "Completion of two years studies in college",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Assistant II (Bookkeeper)",
                "salary_grade_id" => 8,
                "education" => "Completion of two years studies in college",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Assistant II (Carpernter Foreman)",
                "salary_grade_id" => 8,
                "education" => "High School Graduate or Completion of the Required Vocational/Trade Course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Carpenter (CSC MC 11, s 1996 Cat. II)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Assistant III",
                "salary_grade_id" => 9,
                "education" => "Completion of two years studies in college",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Assistant V",
                "salary_grade_id" => 11,
                "education" => "Completion of two years studies in college",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Assistant VI",
                "salary_grade_id" => 12,
                "education" => "Completion of two years study in college",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Officer I",
                "salary_grade_id" => 10,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Officer II",
                "salary_grade_id" => 11,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "1 year of relevant experience",
                "training" => "None Required",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Officer III",
                "salary_grade_id" => 14,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Officer IV",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Officer V",
                "salary_grade_id" => 18,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Administrative Officer  V (for BeGH)",
                "salary_grade_id" => 18,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "2 years of experience  as Administrative Officer IV",
                "training" => "With Managerial Training and completion of the Training Course on the International Classification of  (ICD-10) for CodesDiseases Version 10",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Agricultural Center Chief",
                "salary_grade_id" => 20,
                "education" => "Bachelor's degree in Agriculture or other allied courses such as Agricultural Engineering, Fisheries Technology and Veterinary Medicine",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "Relevant RA 1080"
            ],
            [
                "code" => "***",
                "title" => "Agricultural Technician",
                "salary_grade_id" => 8,
                "education" => "Completion of two years studies in college",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Sub professional"
            ],
            [
                "code" => "***",
                "title" => "Agricultural Technologist",
                "salary_grade_id" => 10,
                "education" => "Bachelor's degree in Agriculture or other allied courses such as Agricultural Engineering, Fisheries Technology and Veterinary Medicine",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Relevant RA 1080"
            ],
            [
                "code" => "***",
                "title" => "Agriculturist I",
                "salary_grade_id" => 11,
                "education" => "Bachelor's degree in Agriculture or other allied courses such as Agricultural Engineering, Fisheries Technology and Veterinary Medicine",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Relevant RA 1080"
            ],
            [
                "code" => "***",
                "title" => "Agriculturist II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree in Agriculture or other allied courses such as Agricultural Engineering, Fisheries Technology and Veterinary Medicine",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "Relevant RA 1080"
            ],
            [
                "code" => "***",
                "title" => "Animal Keeper I",
                "salary_grade_id" => 2,
                "education" => "Must be able to read and write",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Animal Keeper II",
                "salary_grade_id" => 4,
                "education" => "Must be able to read and write",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Architect I",
                "salary_grade_id" => 12,
                "education" => "BS in Architecture",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "RA 1080 (Architect)"
            ],
            [
                "code" => "***",
                "title" => "Architect II",
                "salary_grade_id" => 16,
                "education" => "BS in Architecture",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080 (Architect)"
            ],
            [
                "code" => "***",
                "title" => "Assessment Clerk I",
                "salary_grade_id" => 4,
                "education" => "Completion of two years study in college",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Assessment Clerk II",
                "salary_grade_id" => 6,
                "education" => "Completion of two years study in college",
                "experience" => "None Required",
                "training" => "one Required",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Assessment Clerk III",
                "salary_grade_id" => 9,
                "education" => "Completion of two years study in college",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Assistant Provincial Administrator",
                "salary_grade_id" => 24,
                "education" => "Master's degree or Certificate    in Leadership and management from the Civil Service Commission (CSC)",
                "experience" => "5 years of  supervisory/ management",
                "training" => "120 hours of supervisory/ management learning and development intervention undertaken within the last    five (5) years",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Assistant Provincial Assessor",
                "salary_grade_id" => 24,
                "education" => "Bachelor's degree preferably in Civil or Mechanical Engineering, Commerce or related course",
                "experience" => "3 years of  in  real property assessment works or in any related field",
                "training" => "32 hours of relevant training",
                "eligibility" => "RA 1080 ((Real Estate Services)"
            ],
            [
                "code" => "***",
                "title" => "Assistant Provincial Engineer",
                "salary_grade_id" => 24,
                "education" => "BS in Civil Engineering",
                "experience" => "3 years of  in civil engineering works",
                "training" => "32 hours of relevant training",
                "eligibility" => "RA 1080 (Civil Engineer)"
            ],
            [
                "code" => "***",
                "title" => "Assistant Provincial Legal Officer",
                "salary_grade_id" => 24,
                "education" => "Bachelor of Laws",
                "experience" => "4 years of  in civil engineering works",
                "training" => "None Required",
                "eligibility" => "RA 1080 (Lawyer)"
            ],
            [
                "code" => "***",
                "title" => "Assistant Provincial  Treasurer",
                "salary_grade_id" => 24,
                "education" => "Bachelor's degree preferably in Commerce,  Public Administration or Law",
                "experience" => "3 years of  in civil engineering works",
                "training" => "32 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Assistant Provincial Warden",
                "salary_grade_id" => 18,
                "education" => "Bachelor's degree",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Attorney IV",
                "salary_grade_id" => 23,
                "education" => "Bachelor of Laws",
                "experience" => "2 years of relevant experience",
                "training" => "hours of relevant training",
                "eligibility" => "RA 1080 (Lawyer)"
            ],
            [
                "code" => "***",
                "title" => "Board Secretary I",
                "salary_grade_id" => 14,
                "education" => "Bachelor's degree",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Board Secretary II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree",
                "experience" => "1 year of relevant",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Board Secretary III",
                "salary_grade_id" => 20,
                "education" => "Bachelor's degree",
                "experience" => "2 years of relevant",
                "training" => "8 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Board Secretary IV",
                "salary_grade_id" => 22,
                "education" => "Bachelor's degree",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Carpenter I",
                "salary_grade_id" => 3,
                "education" => "Elementary School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Carpenter"
            ],
            [
                "code" => "***",
                "title" => "Chief Administrative Officer",
                "salary_grade_id" => 24,
                "education" => "Master? Degree",
                "experience" => "4 years of  in position/s involving management and supervision",
                "training" => "24 hours of training in management and supervision",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Chief of Medical Professional Staff I",
                "salary_grade_id" => 25,
                "education" => "Doctor of Medicine",
                "experience" => "3 years of supervisory/managerial",
                "training" => "None Required",
                "eligibility" => "RA 1080"
            ],
            [
                "code" => "***",
                "title" => "Chief of Hospital I",
                "salary_grade_id" => 24,
                "education" => "Doctor of Medicine",
                "experience" => "2 years of supervisory",
                "training" => "8 hours of managerial training",
                "eligibility" => "RA 1080"
            ],
            [
                "code" => "***",
                "title" => "Chief of Hospital III",
                "salary_grade_id" => 26,
                "education" => "MS in Hospital Administration or related course",
                "experience" => "Five years supervisory/managerial",
                "training" => "None Required",
                "eligibility" => "Career Service Executive Eligibility"
            ],
            [
                "code" => "***",
                "title" => "Chief Tourism Operations Officer",
                "salary_grade_id" => 24,
                "education" => "Master's degree in tourism, business, economics, marketing, public administration or other related course or Bachelor of Laws",
                "experience" => "4 years of work  and involvement on the tourism industry either in the private sector or the government",
                "training" => "24 hours of training in management/supervision",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Community Affairs Officer II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Community Development Assistant I",
                "salary_grade_id" => 7,
                "education" => "Completion of two years studies in college",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Community Development Assistant II",
                "salary_grade_id" => 9,
                "education" => "Completion of two years studies in college",
                "experience" => "1 year of relevant",
                "training" => "relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Community Development Officer II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Computer Maintenance Technologist I",
                "salary_grade_id" => 11,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Computer Maintenance Technologist II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "1 year of relevant",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Construction and Maintenance Capataz",
                "salary_grade_id" => 5,
                "education" => "Elementary School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Construction and Maintenance Foreman",
                "salary_grade_id" => 8,
                "education" => "High School Graduate",
                "experience" => "1 year of relevant",
                "training" => "4 hours of relevant training",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Construction and Maintenance General Foreman",
                "salary_grade_id" => 11,
                "education" => "High School Graduate",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Construction and Maintenance Man",
                "salary_grade_id" => 2,
                "education" => "Elementary School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Cook I",
                "salary_grade_id" => 3,
                "education" => "Elementary School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Cook II",
                "salary_grade_id" => 5,
                "education" => "Elementary School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Cooperative Development Specialist II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Dental Aide",
                "salary_grade_id" => 4,
                "education" => "High School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None  Required"
            ],
            [
                "code" => "***",
                "title" => "Dentist II",
                "salary_grade_id" => 16,
                "education" => "Doctor of Dental Medicine  or Dental Surgery",
                "experience" => "1 year of relevant",
                "training" => "hours of relevant training",
                "eligibility" => "RA 1080 (Dentist)"
            ],
            [
                "code" => "***",
                "title" => "Dentist III",
                "salary_grade_id" => 19,
                "education" => "Doctor of Dental Medicine  or Dental Surgery",
                "experience" => "2years of relevant",
                "training" => "8 hours of relevant training",
                "eligibility" => "RA 1080 (Dentist)"
            ],
            [
                "code" => "***",
                "title" => "Dentist IV",
                "salary_grade_id" => 22,
                "education" => "Doctor of Dental Medicine  or Dental Surgery",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "RA 1080 (Dentist)"
            ],
            [
                "code" => "***",
                "title" => "Draftsman II",
                "salary_grade_id" => 8,
                "education" => "Completion of two years study in college  /High School Graduate with relevant vocational/trade course",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "Draftsman or Illustrator / CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Draftsman III",
                "salary_grade_id" => 11,
                "education" => "Completion of two years studies in college/High School Graduate with relevant vocational/trade course",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "Draftsman or Illustrator / CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Driver I",
                "salary_grade_id" => 3,
                "education" => "Elementary School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Driver's License"
            ],
            [
                "code" => "***",
                "title" => "Economist II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Engineer I",
                "salary_grade_id" => 12,
                "education" => "Bachelor's degree in Engineering relevant",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Relevant RA 1080"
            ],
            [
                "code" => "***",
                "title" => "Engineer II",
                "salary_grade_id" => 16,
                "education" => "Bachelor's degree in Engineering relevant",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "Relevant RA 1080"
            ],
            [
                "code" => "***",
                "title" => "Engineer III",
                "salary_grade_id" => 19,
                "education" => "Bachelor's degree in Engineering relevant",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "Relevant RA 1080"
            ],
            [
                "code" => "***",
                "title" => "Engineer IV",
                "salary_grade_id" => 22,
                "education" => "Bachelor's degree in Engineering relevant",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "Relevant RA 1080"
            ],
            [
                "code" => "***",
                "title" => "Engineering Assistant",
                "salary_grade_id" => 8,
                "education" => "Completion of two years study in college",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Executive Assistant I",
                "salary_grade_id" => 14,
                "education" => "Bachelor's Degree",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Executive Assistant II",
                "salary_grade_id" => 17,
                "education" => "Bachelor's Degree",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Executive Assistant III",
                "salary_grade_id" => 20,
                "education" => "Bachelor's Degree",
                "experience" => "2 years of relevant",
                "training" => "8 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Executive Assistant IV",
                "salary_grade_id" => 22,
                "education" => "Bachelor's Degree",
                "experience" => "3 years of relevant",
                "training" => "16 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Farm Foreman",
                "salary_grade_id" => 6,
                "education" => "High School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Farm Supervisor",
                "salary_grade_id" => 8,
                "education" => "High School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Farm Worker I",
                "salary_grade_id" => 2,
                "education" => "Elementary School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Farm Worker II",
                "salary_grade_id" => 4,
                "education" => "Elementary School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Heavy Equipment Operator I",
                "salary_grade_id" => 4,
                "education" => "High School Graduate or completion of the relevant vocational/trade course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Heavy Equipment Operator NC II"
            ],
            [
                "code" => "***",
                "title" => "Heavy Equipment Operator II",
                "salary_grade_id" => 6,
                "education" => "High School Graduate or completion of the relevant vocational/trade course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Heavy Equipment Operator NC II"
            ],
            [
                "code" => "***",
                "title" => "Information System Analyst III",
                "salary_grade_id" => 19,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Instructor I",
                "salary_grade_id" => 12,
                "education" => "Bachelor's degree in the area  of specialization",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "RA 1080/"
            ],
            [
                "code" => "***",
                "title" => "Laboratory Aide",
                "salary_grade_id" => 4,
                "education" => "Elementary School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Labor and Employment Officer III",
                "salary_grade_id" => 16,
                "education" => "Bachelor's Degree",
                "experience" => "1 year of relevant",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Laundry Worker I",
                "salary_grade_id" => 1,
                "education" => "Must be able to read and write",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Laundry Worker  II",
                "salary_grade_id" => 3,
                "education" => "Must be able to read and write",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Legal Aide",
                "salary_grade_id" => 5,
                "education" => "Completion of two years study in college",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Legal Assistant II",
                "salary_grade_id" => 12,
                "education" => "BS in Legal Management, AB Paralegal Studies, Law, Political Science or other allied courses",
                "experience" => "None Required",
                "training" => "4 hours of training relevant to legal work such as legal ethics, legal research and writing or  legal procedure",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Librarian I",
                "salary_grade_id" => 11,
                "education" => "Bachelor's Degree in Library Science or Information Science or Bachelor of Science in Education/Arts major in Library Science",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "RA 1080 (Librarian)"
            ],
            [
                "code" => "***",
                "title" => "Librarian II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's Degree in Library Science or Information Science or Bachelor of Science in Education/Arts major in Library Science",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080 (Librarian)"
            ],
            [
                "code" => "***",
                "title" => "Librarian III",
                "salary_grade_id" => 18,
                "education" => "Bachelor's Degree in Library Science or Information Science or Bachelor of Science in Education/Arts major in Library Science",
                "experience" => "2 years of relevant",
                "training" => "8 hours of relevant training",
                "eligibility" => "RA 1080 (Librarian)"
            ],
            [
                "code" => "***",
                "title" => "Librarian IV",
                "salary_grade_id" => 22,
                "education" => "Bachelor's Degree in Library Science or Information Science or Bachelor of Science in Education/Arts major in Library Science",
                "experience" => "3 years of relevant",
                "training" => "16 hours of relevant training",
                "eligibility" => "RA 1080 (Librarian)"
            ],
            [
                "code" => "***",
                "title" => "Local Assessment Operations Officer I",
                "salary_grade_id" => 11,
                "education" => "Bachelor's degree",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "RA 1080 (Real Estate Service)"
            ],
            [
                "code" => "***",
                "title" => "Local Assessment  Operations Officer II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080 (Real Estate Service)"
            ],
            [
                "code" => "***",
                "title" => "Local Assessment Operations Officer III",
                "salary_grade_id" => 18,
                "education" => "Bachelor's degree",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "RA 1080 (Real Estate Service)"
            ],
            [
                "code" => "***",
                "title" => "Local Assessment Operations Officer IV",
                "salary_grade_id" => 22,
                "education" => "Bachelor's degree",
                "experience" => "3 years of relevant",
                "training" => "16 hours of relevant training",
                "eligibility" => "RA 1080 (Real Estate Service)"
            ],
            [
                "code" => "***",
                "title" => "Local Disaster Risk Reduction and Management Assistant",
                "salary_grade_id" => 8,
                "education" => "Completion of two years study in college",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training  on disaster risk reduction management",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Local Disaster Risk Reduction and Management Officer I",
                "salary_grade_id" => 11,
                "education" => "Bachelor's Degree",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Local Disaster Risk Reduction and Management Officer II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's Degree",
                "experience" => "1 year of relevant on disaster risk reduction management",
                "training" => "4 hours of relevant training on disaster risk reduction management",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Local Disaster Risk Reduction and Management Officer IV",
                "salary_grade_id" => 22,
                "education" => "Bachelor's Degree",
                "experience" => "1 year of relevant on disaster risk reduction management",
                "training" => "16 hours of relevant training  on disaster risk reduction management",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Local Legislative Staff Assistant II",
                "salary_grade_id" => 8,
                "education" => "Completion of two years study in college",
                "experience" => "1 year of relevant on disaster risk reduction management",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Local Legislative Staff Assistant III",
                "salary_grade_id" => 10,
                "education" => "Completion of two years studies in college",
                "experience" => "2 years of relevant experience  on disaster risk reduction management",
                "training" => "8 hours of relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Local Legislative Staff Officer I",
                "salary_grade_id" => 11,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Local Legislative Staff Officer III",
                "salary_grade_id" => 16,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Local Revenue Collection Officer I",
                "salary_grade_id" => 11,
                "education" => "Bachelor's degree",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Local Treasurer Eligibility (LTE)"
            ],
            [
                "code" => "***",
                "title" => "Local Revenue Collection Officer II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree",
                "experience" => "1 year of relevant",
                "training" => "4 hours of relevant training",
                "eligibility" => "Local Treasurer Eligibility (LTE)"
            ],
            [
                "code" => "***",
                "title" => "Local Revenue Collection Officer III",
                "salary_grade_id" => 18,
                "education" => "Bachelor's degree",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "Local Treasurer Eligibility (LTE)"
            ],
            [
                "code" => "***",
                "title" => "Local Revenue Collection Officer IV",
                "salary_grade_id" => 22,
                "education" => "Bachelor's degree",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "Local Treasurer Eligibility (LTE)"
            ],
            [
                "code" => "***",
                "title" => "Local Treasury Operations Officer I",
                "salary_grade_id" => 11,
                "education" => "Bachelor's degree",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Local Treasurer Eligibility (LTE)"
            ],
            [
                "code" => "***",
                "title" => "Local Treasury Operations Officer II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree",
                "experience" => "1 year of relevant",
                "training" => "4 hours of relevant training",
                "eligibility" => "Local Treasurer Eligibility (LTE)"
            ],
            [
                "code" => "***",
                "title" => "Local Treasury Operations Officer III",
                "salary_grade_id" => 18,
                "education" => "Bachelor's degree",
                "experience" => "2 years of relevant",
                "training" => "8 hours of relevant training",
                "eligibility" => "Local Treasurer Eligibility (LTE)"
            ],
            [
                "code" => "***",
                "title" => "Local Treasury Operations Officer IV",
                "salary_grade_id" => 22,
                "education" => "Bachelor's degree",
                "experience" => "3 years of relevant",
                "training" => "16 hours of relevant training",
                "eligibility" => "Local Treasurer Eligibility (LTE)"
            ],
            [
                "code" => "***",
                "title" => "Mechanic II",
                "salary_grade_id" => 6,
                "education" => "High School Graduate or completion of the relevant vocational/trade course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Mechanic (Automotive Servicing, -250 volts) / (CSC MC 3, s. 2008)"
            ],
            [
                "code" => "***",
                "title" => "Mechanic III",
                "salary_grade_id" => 9,
                "education" => "High School Graduate or completion of the relevant vocational/trade course",
                "experience" => "1 year of relevant",
                "training" => "4 hours of relevant training",
                "eligibility" => "Mechanic (Automotive Servicing, -250 volts) / (CSC MC 3, s. 2008)"
            ],
            [
                "code" => "***",
                "title" => "Medical Equipment Technician I",
                "salary_grade_id" => 6,
                "education" => "Completion of two years study in college or completion  of the required vocational/trade course",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Medical Equipment Technician III",
                "salary_grade_id" => 11,
                "education" => "Completion of two years study in college or completion  of the required vocational/trade course",
                "experience" => "2 years of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "Equipment Technician (CSC MC. 3 s. 2008)"
            ],
            [
                "code" => "***",
                "title" => "Medical Laboratory Technician I",
                "salary_grade_id" => 6,
                "education" => "BS in Medical Technology or  BS in Public Health",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "RA 1080 (Medical Laboratory Technician)"
            ],
            [
                "code" => "***",
                "title" => "Medical Laboratory Technician III",
                "salary_grade_id" => 10,
                "education" => "BS in Medical Technology or BS in Public Health",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "RA 1080 (Medical Laboratory Technician)"
            ],
            [
                "code" => "***",
                "title" => "Medical Officer III",
                "salary_grade_id" => 21,
                "education" => "Doctor of Medicine",
                "experience" => "Volunteer service or 1 month",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080 (Physician)"
            ],
            [
                "code" => "***",
                "title" => "Medical Officer IV",
                "salary_grade_id" => 23,
                "education" => "Doctor of Medicine",
                "experience" => "5 years of  in the department where vacancy exists",
                "training" => "Residency training from a training hospital",
                "eligibility" => "RA 1080 (Physician)"
            ],
            [
                "code" => "***",
                "title" => "Medical Officer IV (for District Hospital)",
                "salary_grade_id" => 23,
                "education" => "Doctor of Medicine",
                "experience" => "1 year   as Medical Officer III",
                "training" => "16 hours of relevant training",
                "eligibility" => "RA 1080 (Physician)"
            ],
            [
                "code" => "***",
                "title" => "Medical Specialist I",
                "salary_grade_id" => 22,
                "education" => "Doctor of Medicine",
                "experience" => "1 year relevant",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080 (Physician)"
            ],
            [
                "code" => "***",
                "title" => "Medical Specialist II",
                "salary_grade_id" => 23,
                "education" => "Doctor of Medicine",
                "experience" => "5 years of   as Medical Officer IV in the department  where vacancy exists",
                "training" => "Residency training in the specific department, Diplomate or Fellow, MS-DOH Certified",
                "eligibility" => "RA 1080 (Physician)"
            ],
            [
                "code" => "***",
                "title" => "Medical Specialist III",
                "salary_grade_id" => 24,
                "education" => "Doctor of Medicine",
                "experience" => "2 years of   as Medical Specialist II",
                "training" => "Residency training and MS-DOH Certified",
                "eligibility" => "RA 1080 (Physician)"
            ],
            [
                "code" => "***",
                "title" => "Medical Technologist I",
                "salary_grade_id" => 11,
                "education" => "Bachelor of Science in Medical Technology",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "RA 1080 (Medical Technologist)"
            ],
            [
                "code" => "***",
                "title" => "Medical Technologist II",
                "salary_grade_id" => 15,
                "education" => "Bachelor of Science in Medical Technology",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080 (Medical Technologist)"
            ],
            [
                "code" => "***",
                "title" => "Midwife II",
                "salary_grade_id" => 11,
                "education" => "Completion of the midwifery course",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080 (Midwife)"
            ],
            [
                "code" => "***",
                "title" => "Nurse I",
                "salary_grade_id" => 11,
                "education" => "Bachelor of Science in Nursing",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Ra 1080 (Nurse)"
            ],
            [
                "code" => "***",
                "title" => "Nurse II",
                "salary_grade_id" => 15,
                "education" => "Bachelor of Science in Nursing",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "Ra 1080 (Nurse)"
            ],
            [
                "code" => "***",
                "title" => "Nurse III",
                "salary_grade_id" => 17,
                "education" => "Bachelor of Science in Nursing",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "Ra 1080 (Nurse)"
            ],
            [
                "code" => "***",
                "title" => "Nurse IV",
                "salary_grade_id" => 19,
                "education" => "Bachelor of Science in Nursing",
                "experience" => "2 years  of relevant",
                "training" => "8 hours of relevant training",
                "eligibility" => "Ra 1080 (Nurse)"
            ],
            [
                "code" => "***",
                "title" => "Nurse VI",
                "salary_grade_id" => 22,
                "education" => "Bachelor of Science in Nursing with at least 9 units in management course at the graduate level",
                "experience" => "3 years  of relevant",
                "training" => "16 hours of relevant training",
                "eligibility" => "Ra 1080 (Nurse)"
            ],
            [
                "code" => "***",
                "title" => "Nursing Attendant I",
                "salary_grade_id" => 4,
                "education" => "Completion of Midwifery Course",
                "experience" => "1 year of experience  as  Nursing Attendant",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080 (Midwife)"
            ],
            [
                "code" => "***",
                "title" => "Nutritionist-Dietitian I",
                "salary_grade_id" => 11,
                "education" => "Bachelor of Science in",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "RA 1080 (Nutritionist)"
            ],
            [
                "code" => "***",
                "title" => "Nutritionist-Dietitian II",
                "salary_grade_id" => 15,
                "education" => "Bachelor of Science in",
                "experience" => "1 year of relevant",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080 (Nutritionist)"
            ],
            [
                "code" => "***",
                "title" => "Nutritionist-Dietitian III",
                "salary_grade_id" => 18,
                "education" => "Bachelor of Science in",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "RA 1080 (Nutritionist)"
            ],
            [
                "code" => "***",
                "title" => "Pharmacist I",
                "salary_grade_id" => 11,
                "education" => "Bachelor of Science in Pharmacy",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "RA 1080 (Pharmacist)"
            ],
            [
                "code" => "***",
                "title" => "Pharmacist II",
                "salary_grade_id" => 15,
                "education" => "Bachelor of Science in Pharmacy",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080 (Pharmacist)"
            ],
            [
                "code" => "***",
                "title" => "Pharmacist III",
                "salary_grade_id" => 18,
                "education" => "Bachelor of Science in Pharmacy",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080 (Pharmacist)"
            ],
            [
                "code" => "***",
                "title" => "Planning Officer II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Population Program  Officer II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Population Program Worker II",
                "salary_grade_id" => 7,
                "education" => "Completion of two years studies in college",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Subrofessional"
            ],
            [
                "code" => "***",
                "title" => "Prison Guard I",
                "salary_grade_id" => 5,
                "education" => "Completion of two years study in college",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Subrofessional"
            ],
            [
                "code" => "***",
                "title" => "Prison Guard II",
                "salary_grade_id" => 7,
                "education" => "Completion of two years study in college",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Subrofessional"
            ],
            [
                "code" => "***",
                "title" => "Prison Guard III",
                "salary_grade_id" => 10,
                "education" => "Completion of two years studies in college",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "CS Subrofessional"
            ],
            [
                "code" => "***",
                "title" => "Private Secretary II",
                "salary_grade_id" => 15,
                "education" => "Completion of two years studies in college",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Project Development Assistant",
                "salary_grade_id" => 8,
                "education" => "Completion of two years studies in college",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Subrofessional"
            ],
            [
                "code" => "***",
                "title" => "Project Development Officer I",
                "salary_grade_id" => 11,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Project Development Officer II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Project Development Officer III",
                "salary_grade_id" => 18,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Project Development Officer IV",
                "salary_grade_id" => 11,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Provincial Warden",
                "salary_grade_id" => 22,
                "education" => "Bachelor's degree",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Radiologic Technologist II",
                "salary_grade_id" => 13,
                "education" => "Bachelor's degree in Radiologic Technologist",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "RA 1080 (Radiologic Technologist)"
            ],
            [
                "code" => "***",
                "title" => "Radiologic Technologist III",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree in Radiologic Technologist",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "RA 1080 (Radiologic Technologist)"
            ],
            [
                "code" => "***",
                "title" => "Respiratory Therapist",
                "salary_grade_id" => 10,
                "education" => "Bachelor's degree in Respiratory Therapy",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "RA 1080  (Respiratory Therapist)"
            ],
            [
                "code" => "***",
                "title" => "Revenue Collection Clerk I",
                "salary_grade_id" => 5,
                "education" => "Completion of two years studies in college",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Subrofessional"
            ],
            [
                "code" => "***",
                "title" => "Revenue Collection Clerk II",
                "salary_grade_id" => 7,
                "education" => "Completion of two years studies in college",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Subrofessional"
            ],
            [
                "code" => "***",
                "title" => "Rural Health Physician",
                "salary_grade_id" => 24,
                "education" => "Doctor of Medicine",
                "experience" => "1 year of experience as Medical Specialist III",
                "training" => "With managerial training",
                "eligibility" => "RA 1080 (Physician)"
            ],
            [
                "code" => "***",
                "title" => "Sanitation Inspector I",
                "salary_grade_id" => 6,
                "education" => "Completion of two years study in college",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Subrofessional"
            ],
            [
                "code" => "***",
                "title" => "Sanitation Inspector II",
                "salary_grade_id" => 8,
                "education" => "Completion of two years studies in college",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Subrofessional"
            ],
            [
                "code" => "***",
                "title" => "Sanitation Inspector IV",
                "salary_grade_id" => 13,
                "education" => "Completion of two years study in college",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "CS Subrofessional"
            ],
            [
                "code" => "***",
                "title" => "Seamstress",
                "salary_grade_id" => 2,
                "education" => "Elementary School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Security Guard I",
                "salary_grade_id" => 3,
                "education" => "High School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Security Guard License"
            ],
            [
                "code" => "***",
                "title" => "Security Guard II",
                "salary_grade_id" => 5,
                "education" => "High School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Security Guard License"
            ],
            [
                "code" => "***",
                "title" => "Security Officer II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Senior Administrative Assistant I",
                "salary_grade_id" => 13,
                "education" => "Completion of two years studies in college",
                "experience" => "3 years of relevant experience",
                "training" => "16  hours of relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Senior Agriculturist",
                "salary_grade_id" => 18,
                "education" => "Bachelor's degree in Agriculture or other allied courses such as Agricultural Engineering, Fisheries Technology and Veterinary Medicine",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "Relevant RA 1080"
            ],
            [
                "code" => "***",
                "title" => "Senior Environment Management Specialist",
                "salary_grade_id" => 18,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Social Welfare Aide",
                "salary_grade_id" => 4,
                "education" => "High School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Social Welfare Assistant",
                "salary_grade_id" => 8,
                "education" => "BS in Social Work",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080 (Social Worker)"
            ],
            [
                "code" => "***",
                "title" => "Social Welfare Officer I",
                "salary_grade_id" => 11,
                "education" => "BS in Social Work",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "RA 1080 (Social Worker)"
            ],
            [
                "code" => "***",
                "title" => "Social Welfare Officer II",
                "salary_grade_id" => 15,
                "education" => "BS in Social Work",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080 (Social Worker)"
            ],
            [
                "code" => "***",
                "title" => "Social Welfare Officer III",
                "salary_grade_id" => 18,
                "education" => "BS in Social Work",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "RA 1080 (Social Worker)"
            ],
            [
                "code" => "***",
                "title" => "Social Welfare Officer IV",
                "salary_grade_id" => 22,
                "education" => "BS in Social Work",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "RA 1080 (Social Worker)"
            ],
            [
                "code" => "***",
                "title" => "Special Investigator I",
                "salary_grade_id" => 11,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Sports Development Officer II",
                "salary_grade_id" => 14,
                "education" => "Bachelor's degree",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Supervising Administrative  Officer",
                "salary_grade_id" => 22,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Supervising Agriculturist",
                "salary_grade_id" => 22,
                "education" => "Bachelor's degree in Agriculture or other allied courses such as Agricultural Engineering, Fisheries Technology and Veterinary Medicine",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "Relevant RA 1080"
            ],
            [
                "code" => "***",
                "title" => "Supervising Environment Management Specialist",
                "salary_grade_id" => 22,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Supervising Tourism Operations Officer",
                "salary_grade_id" => 22,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Tax Mapper I",
                "salary_grade_id" => 11,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Tax Mapper II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Tax Mapper IV",
                "salary_grade_id" => 22,
                "education" => "Bachelor's degree relevant to the job",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Tourism Operations Officer I",
                "salary_grade_id" => 11,
                "education" => "Bachelor's degree in tourism, business law, economics, marketing, public administration or other related fields",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Tourism Operations Officer II",
                "salary_grade_id" => 15,
                "education" => "Bachelor's degree in tourism, business law, economics, marketing, public administration or other related fields",
                "experience" => "1 year of work  and involvement in the tourism industry either in the private sector or in the government",
                "training" => "8 hours of relevant training on tourism or DOT specific and mandatory trainings such as but not limited to the following=>      ?� Tourism Awareness and Capability Building Seminar for LGUs ?� Seminar on Disaster Risk Reduction and Management ?� Basic Tourism Statistics Training (BTST) ?� Local Tourism Guidebook Orientation and; ?� Seminar on GAD",
                "eligibility" => "CS Professional (2nd level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Veterinarian I",
                "salary_grade_id" => 13,
                "education" => "Doctor of Veterinary Medicine",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "RA 1080 (Veterinarian)"
            ],
            [
                "code" => "***",
                "title" => "Veterinarian II",
                "salary_grade_id" => 16,
                "education" => "Doctor of Veterinary Medicine",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "RA 1080"
            ],
            [
                "code" => "***",
                "title" => "Veterinarian III",
                "salary_grade_id" => 19,
                "education" => "Doctor of Veterinary Medicine",
                "experience" => "2 years of relevant experience",
                "training" => "8 hours of relevant training",
                "eligibility" => "RA 1080 (Veterinarian)"
            ],
            [
                "code" => "***",
                "title" => "Veterinarian IV",
                "salary_grade_id" => 22,
                "education" => "Doctor of Veterinary Medicine",
                "experience" => "3 years of relevant experience",
                "training" => "16 hours of relevant training",
                "eligibility" => "RA 1080 (Veterinarian)"
            ],
            [
                "code" => "***",
                "title" => "Warehouseman II",
                "salary_grade_id" => 8,
                "education" => "Completion of two years studies in college",
                "experience" => "1 year of relevant experience",
                "training" => "4 hours of relevant training",
                "eligibility" => "CS Subprofessional (1st level Eligibility)"
            ],
            [
                "code" => "***",
                "title" => "Watchman I",
                "salary_grade_id" => 2,
                "education" => "Elementary School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Watchman I",
                "salary_grade_id" => 2,
                "education" => "Elementary School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "None Required"
            ],
            [
                "code" => "***",
                "title" => "Welder II",
                "salary_grade_id" => 6,
                "education" => "Elementary School Graduate",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "Welder"
            ],
            [
                "code" => "PGDH-PACCO",
                "title" => "Provincial Accountant",
                "salary_grade_id" => 26,
                "education" => "Bachelor of Accountancy, BS in Commerce/Business Administration major in Accounting",
                "experience" => "5 years s in the treasury or accounting service",
                "training" => "32 hours of relevant training",
                "eligibility" => "RA 1080 (Accountant)"
            ],
            [
                "code" => "PGDH-ADM",
                "title" => "Provincial Administrator",
                "salary_grade_id" => 26,
                "education" => "Bachelor's degree preferably in Public Administration, Law or any related course",
                "experience" => "5 years of   in management and administration work",
                "training" => "32 hours of relevant training",
                "eligibility" => "2nd level eligibility"
            ],
            [
                "code" => "PGDH-AGRI",
                "title" => "Provincial Agriculturist",
                "salary_grade_id" => 26,
                "education" => "Bachelor's degree in Agriculture or other allied courses such as Agricultural Engineering, Fisheries Technology and Veterinary Medicine",
                "experience" => "5 years acquired in agriculture or in any related field",
                "training" => "32 hours of relevant training",
                "eligibility" => "Relevant RA 1080"
            ],
            [
                "code" => "PGDH-ASSO",
                "title" => "Provincial Assessor",
                "salary_grade_id" => 26,
                "education" => "Bachelor's degree preferably in Civil or Mechanical Engineering, Commerce or any related course",
                "experience" => "5 years of in real property assessment work in any related field",
                "training" => "32 hours of relevant training",
                "eligibility" => "RA 1080 (Real Estate Service)"
            ],
            [
                "code" => "PGDH-BO",
                "title" => "Provincial Budget Officer",
                "salary_grade_id" => 26,
                "education" => "Bachelor's degree preferably in Accounting, Economics, Public Administration or any related course",
                "experience" => "5 years of in budgeting or in any related field",
                "training" => "32 hours of relevant training",
                "eligibility" => "2nd level eligibility"
            ],
            [
                "code" => "PGDH-EO",
                "title" => "Provincial Engineer",
                "salary_grade_id" => 26,
                "education" => "Bachelor's degree in Civil Engineering",
                "experience" => "5 year in the practice of engineering",
                "training" => "32 hours of relevant training",
                "eligibility" => "RA 1080"
            ],
            [
                "code" => "PGDH-GSO",
                "title" => "Provincial General Services Officer",
                "salary_grade_id" => 26,
                "education" => "Bachelor's degree in Public Administration, Business Administration and Management",
                "experience" => "5 years of in general services including management of supply, property, solid waste disposal and general sanitation",
                "training" => "32 hours of relevant training",
                "eligibility" => "2nd level eligibility"
            ],
            [
                "code" => "PGDH-ENRO",
                "title" => "Provincial Environment and natural Resources Officer",
                "salary_grade_id" => 26,
                "education" => "Bachelor's degree in Environment, Forestry, Agriculture or any related course",
                "experience" => "5 years of  in environmental and natural resources, management, conservation and utilization",
                "training" => "32 hours of relevant training",
                "eligibility" => "2nd level eligibility"
            ],
            [
                "code" => "PGDH-HO",
                "title" => "Provincial Health Officer II",
                "salary_grade_id" => 26,
                "education" => "Doctor of Medicine",
                "experience" => "5 years of  as medical practitioner",
                "training" => "32 hours of relevant training",
                "eligibility" => "RA 1080 (Physician)"
            ],
            [
                "code" => "PGDH-LO",
                "title" => "Provincial Legal Officer",
                "salary_grade_id" => 26,
                "education" => "Bachelor of Laws",
                "experience" => "5 years of  in the practice of law",
                "training" => "32 hours of relevant training",
                "eligibility" => "RA 1080 (Lawyer)"
            ],
            [
                "code" => "PGDH-PDO",
                "title" => "Provincial Planning and Development Officer",
                "salary_grade_id" => 26,
                "education" => "Bachelor's degree preferably in Urban Planning Development Studies, Development Studies, Economics, Public Administration or any related course",
                "experience" => "5 years of  in government planning or in any related field",
                "training" => "None",
                "eligibility" => "RA 1080 (Environmental Planner)"
            ],
            [
                "code" => "PGDH-SWDO",
                "title" => "Provincial Social Welfare and Development Officer",
                "salary_grade_id" => 26,
                "education" => "Bachelor of Science  in Social Work",
                "experience" => "5 years of   in the practice of social work",
                "training" => "32 hours of relevant training",
                "eligibility" => "RA 1080 (Social Worker)"
            ],
            [
                "code" => "PGDH-TREAS",
                "title" => "Provincial Treasurer",
                "salary_grade_id" => 26,
                "education" => "Bachelor's degree preferably in Commerce, Public Administration or Law",
                "experience" => "5 years of  in treasury or accounting  service",
                "training" => "32 hours of relevant training",
                "eligibility" => "2nd level eligibility"
            ],
            [
                "code" => "PGDH-VET",
                "title" => "Provincial Veterinarian",
                "salary_grade_id" => 26,
                "education" => "Doctor of Veterinary Medicine",
                "experience" => "3 years of  in the practice of veterinary medicine",
                "training" => 0,
                "eligibility" => "RA 1080 (Veterinarian)"
            ],
            [
                "code" => "PGDH-SP",
                "title" => "Secretary to the Sanggunian",
                "salary_grade_id" => 26,
                "education" => "Bachelor's degree preferably in Law, Commerce or Public Administration",
                "experience" => "None Required",
                "training" => "None Required",
                "eligibility" => "2nd level eligibility"
            ],
            [
                "code" => "***",
                "title" => "Assistant Provincial Assessor",
                "salary_grade_id" => 24,
                "education" => "Bachelor's degree preferably in Civil or Mechanical Engineering, Commerce or related course",
                "experience" => "3 years of  in  real property assessment works or in any related field",
                "training" => "32 hours of relevant training",
                "eligibility" => "RA 1080 ((Real Estate Services)"
            ],
            [
                "code" => "***",
                "title" => "Assistant Provincial Engineer",
                "salary_grade_id" => 24,
                "education" => "BS in Civil Engineering",
                "experience" => "3 years of  in civil engineering works",
                "training" => "32 hours of relevant training",
                "eligibility" => "RA 1080 (Civil Engineer)"
            ],
            [
                "code" => "***",
                "title" => "Assistant Provincial  Legal Officer",
                "salary_grade_id" => 24,
                "education" => "Bachelor of Laws",
                "experience" => "4 years of  in the practice of law",
                "training" => "24 hours of training on Management and Supervision",
                "eligibility" => "RA 1080"
            ],
            [
                "code" => "***",
                "title" => "Assistant Provincial Treasurer",
                "salary_grade_id" => 24,
                "education" => "Bachelor's degree preferably in Commerce, Public Administration or Law",
                "experience" => "5 years of  in the practice of law",
                "training" => "24 hours of training on Management and Supervision",
                "eligibility" => "2nd level eligibility"
            ]
        ];

        foreach ($data as $row) {
            $row = (object) $row;
            $position = Position::where("title", $row->title)->first();
            if ($position != null) {
                // echo ("Hello");
                // $position = Position::where('id',$position->id);
                // $position->salary_grade = $row['salary_grade'];
                // $position->save();
            }


            // $position = Position::create([
            //     "code" => $row->code,
            //     "title" => $row->title,
            //     "salary_grade_id" => $row->salary_grade_id
            // ]);

            // $position->qualificationStandards()->create([
            //     "position_id" => $position->id,
            //     "education" => "Bachelor's degree relevant to the job",
            //     "training" => "None required",
            //     "experience" => "None required",
            //     "eligibility" => "RA 1080/CSC",
            //     'competency' => 'None required',
            // ]);
        }
    }
}
