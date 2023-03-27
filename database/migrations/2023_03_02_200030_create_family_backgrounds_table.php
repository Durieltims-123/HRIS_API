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
        Schema::create('family_backgrounds', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('personal_data_sheet_id')->constrained('personal_data_sheets');
            $table->foreignId('personal_data_sheet_id')->constrained()->onDelete('cascade');
            $table->string('spouse_surname');
            $table->string('spouse_first_name');
            $table->string('spouse_middle_name');
            $table->string('name_extension');
            $table->string('occupation');
            $table->string('employee_business_name');
            $table->string('business_address');
            $table->string('telephone_number');
            $table->string('father_surname');
            $table->string('father_first_name');
            $table->string('father_middle_name');  
            $table->string('father_extension_name'); 
            $table->string('mother_maiden_surname'); 
            $table->string('mother_first_name'); 
            $table->string('mother_maiden_middle_name');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_backgrounds');
    }
};
