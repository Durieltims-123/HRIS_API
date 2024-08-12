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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->string('training');
            $table->integer('performance');
            $table->integer('education');
            $table->integer('experience');
            $table->integer('psychological_attributes')->nullable();
            $table->string('appropriate_eligibility')->nullable();
            $table->integer('potential')->nullable();
            $table->integer('awards')->nullable();
            $table->integer('total_remarks')->default(0);
            $table->string('additional_information')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
