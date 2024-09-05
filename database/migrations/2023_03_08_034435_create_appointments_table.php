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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("application_id")->constrained()->nullable();
            $table->foreignId("employee_id")->constrained()->nullable();
            $table->string("nature_of_appointment");
            $table->string("vice")->nullable();
            $table->string("vice_reason")->nullable();
            $table->date("date_of_signing");
            $table->integer("page_no");
            $table->date("date_received");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
