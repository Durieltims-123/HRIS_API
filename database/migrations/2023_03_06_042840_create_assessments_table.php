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
            
            $table->foreignId('application_id')->constrained();
            $table->foreignId('member_id')->constrained('psb_members');
            $table->integer('training');
            $table->integer('performance');
            $table->integer('education');
            $table->integer('experience');
            $table->integer('psychological_attribute')->nullable();
            $table->integer('potential')->nullable();
            $table->integer('awards')->nullable();
            $table->string('additional_information')->nullable();
            $table->string('remarks')->nullable();
            $table->date('date_of_assessment');
            $table->timestamps();

            // $table->foreign('application_id')->references('id')->on('applications');
            // $table->foreign('member_id')->references('id')->on('psb_members');
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
