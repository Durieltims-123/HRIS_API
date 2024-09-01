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
        Schema::create('pds_children_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personal_data_sheet_id')->constrained()->onDelete('cascade');
            $table->foreignId('pds_family_background_id')->constrained()->onDelete('cascade');
            $table->string('number')->nullable();
            $table->string('name')->nullable();
            $table->date('birthday')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pds_children_information');
    }
};
