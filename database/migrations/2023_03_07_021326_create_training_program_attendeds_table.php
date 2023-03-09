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
        Schema::create('training_program_attendeds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pds_id');
            $table->string('program_title');
            $table->string('hours');
            $table->string('type');
            $table->string('conducted_by');
            $table->date('inclusive_dates_from');
            $table->date('inclusive_dates_to');
            $table->timestamps();

            // $table->foreign('pds_id')->references('id')->on('personal_data_sheets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_program_attendeds');
    }
};
