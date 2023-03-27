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
        Schema::create('children_information', function (Blueprint $table) {
            $table->id();

            // $table->foreignId('personal_data_sheet_id')->constrained('personal_data_sheets');
            $table->foreignId('personal_data_sheet_id')->constrained()->onDelete('cascade');
            $table->foreignId('family_background_id')->constrained('family_backgrounds');
            
            $table->string('children_name');
            $table->date('children_birthdate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children_information');
    }
};
