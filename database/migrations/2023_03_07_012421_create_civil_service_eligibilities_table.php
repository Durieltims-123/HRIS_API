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
        Schema::create('civil_service_eligibilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pds_id');
            $table->unsignedBigInteger('license_id');
            $table->string('career_service');
            $table->string('rating');
            $table->date('examination_date');
            $table->string('place_examination');
            $table->string('license_number');
            $table->date('date_validity');
            $table->timestamps();

            $table->unique('license_id');
            // $table->foreign('pds_id')->references('id')->on('personal_data_sheets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('civil_service_eligibilities');
    }
};
