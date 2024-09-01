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
        Schema::create('pds_educational_backgrounds', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('personal_data_sheet_id')->constrained('personal_data_sheets');
            $table->foreignId('personal_data_sheet_id')->constrained()->onDelete('cascade');
            $table->string('level')->nullable();
            $table->string('school_name')->nullable();
            $table->string('degree')->nullable();
            $table->string('period_to');
            $table->string('period_from');
            $table->string('highest_unit_earned')->nullable();
            $table->string('year_graduated')->nullable();
            $table->string('scholarship_academic_awards')->nullable();
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('pds_id')->references('id')->on('personal_data_sheets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pds_educational_backgrounds');
    }
};
