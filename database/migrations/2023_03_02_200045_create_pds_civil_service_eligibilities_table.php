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
        Schema::create('pds_civil_service_eligibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personal_data_sheet_id')->constrained()->onDelete('cascade');
            $table->string('eligibility_title');
            $table->decimal('rating', total: 4, places: 2)->nullable();
            $table->string('date_of_examination_conferment');
            $table->string('place_of_examination_conferment');
            $table->string('license_number')->nullable();
            $table->date('license_date_validity')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pds_civil_service_eligibilities');
    }
};
