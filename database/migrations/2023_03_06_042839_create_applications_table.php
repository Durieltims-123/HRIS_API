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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->morphs('individual');
            $table->foreignId('vacancy_id')->constrained();
            $table->date('date_submitted');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->string('application_type');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('applicant_id')->references('id')->on('applicants');
            // $table->foreign('employee_id')->references('id')->on('employees');
            // $table->foreign('publication_id')->references('id')->on('publications');
            // $table->foreign('notice_id')->references('id')->on('notices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
