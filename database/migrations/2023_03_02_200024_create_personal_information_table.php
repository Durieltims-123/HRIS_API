<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pds_id')->constrained('personal_data_sheets');

            $table->string('mobile_number');
            $table->string('telephone_number');
            $table->string('permanent_house_number');
            $table->string('permanent_subdivision_village');
            $table->string('permanent_street');

            $table->foreignId('permanent_barangay_id')->constrained('barangays');

            $table->foreignId('permanent_municipality_id')->constrained('municipalities');

            $table->foreignId('permanent_province_id')->constrained('provinces');

            $table->string('permanent_zip_code_number');
            $table->string('residential_house_number');
            $table->string('residential_subdivision_village');
            $table->string('residential_street');

            $table->foreignId('residential_barangay_id')->constrained('barangays');

            $table->foreignId('residential_municipality_id')->constrained('municipalities');

            $table->foreignId('residential_province_id')->constrained('provinces');

            $table->string('residential_zip_code_number');
            $table->string('citizenship');
            $table->string('agency_employee');
            $table->string('tin_number');
            $table->string('sss_number');
            $table->string('philhealth_number');
            $table->string('pag_ibig_number');
            $table->string('gsis_number');
            $table->string('blood_type');
            $table->string('weight');
            $table->string('height');
            $table->string('civil_status');
            $table->string('sex');
            $table->string('birthplace');
            $table->date('birthdate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_information');
    }
};
