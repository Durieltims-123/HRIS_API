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
        Schema::create('oath_takers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oathtaking_id')->constrained('oath_takings')->onDelete('cascade');
            $table->foreignId('appointment_id')->constrained();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('office');
            $table->string('job_title');
            $table->string('date_appointed');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oath_takers');
    }
};
