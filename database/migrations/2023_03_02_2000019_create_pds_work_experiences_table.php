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
        Schema::create('pds_work_experiences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('personal_data_sheet_id')->constrained()->onDelete('cascade');
            $table->string('position_title');
            $table->string('office_company');
            $table->string('monthly_salary');
            $table->string('salary_grade');
            $table->string('status_of_appointment');
            $table->string('government_service');
            $table->date('date_from');
            $table->date('date_to')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pds_work_experiences');
    }
};
