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
        Schema::create('pds_personal_information', function (Blueprint $table) {
            $table->id();

            // $table->foreignId('personal_data_sheet_id')->constrained('personal_data_sheets');
            $table->foreignId('personal_data_sheet_id')->constrained()->onDelete('cascade');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->integer('age');
            $table->string('sex');
            $table->string('height');
            $table->string('weight');
            $table->string('citizenship')->nullable();
            $table->enum('citizenship_type', ["By Birth", "By Naturalization"])->nullable();
            $table->string('country')->nullable();
            $table->string('blood_type');
            $table->enum('civil_status', ['Single', 'Married', 'Divorced', 'Widowed']);
            $table->string('tin')->nullable();
            $table->string('gsis')->nullable();
            $table->string('pagibig')->nullable();
            $table->string('philhealth')->nullable();
            $table->string('sss')->nullable();
            $table->string('residential_province');
            $table->string('residential_municipality');
            $table->string('residential_barangay');
            $table->string('residential_house');
            $table->string('residential_subdivision')->nullable();
            $table->string('residential_street')->nullable();
            $table->string('residential_zipcode');
            $table->string('permanent_province');
            $table->string('permanent_municipality');
            $table->string('permanent_barangay');
            $table->string('permanent_house');
            $table->string('permanent_subdivision')->nullable();
            $table->string('permanent_street')->nullable();
            $table->string('permanent_zipcode');
            $table->string('telephone')->nullable();
            $table->string('mobile_number');
            $table->string('email_address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pds_personal_information');
    }
};
