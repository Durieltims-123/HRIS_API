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
        Schema::create('service_record_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->date('date_from');
            $table->date('date_to');
            $table->string('appointment_records');
            $table->string('leave_without_pay');
            $table->string('remarks');
            $table->string('civil_status');
            $table->string('designation');
            $table->string('salary_annum');
            $table->string('division_office');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_record_forms');
    }
};
