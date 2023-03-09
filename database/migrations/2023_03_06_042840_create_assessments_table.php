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
            // $table->foreignId('application_id');
            // $table->foreignId('member_id');
            $table->unsignedBigInteger('application_id');
            $table->unsignedBigInteger('member_id');
            $table->foreign('application_id')->references('id')->on('applications');
            // $table->foreign('member_id')->references('id')->on('members');
            $table->integer('psychological_attribute');
            $table->integer('potential');
            $table->integer('awards');
            $table->string('additional_information');
            $table->string('remarks');
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
