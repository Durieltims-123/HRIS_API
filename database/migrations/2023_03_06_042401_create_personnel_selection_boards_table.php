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
        Schema::create('personnel_selection_boards', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_effectivity');
            $table->date('end_of_effectivity')->nullable();
            $table->string('chairman_prefix')->nullable();
            $table->string('chairman')->nullable();
            $table->string('chairman_position')->nullable();
            $table->string('chairman_office')->nullable();
            $table->string('vice_chairman_prefix')->nullable();
            $table->string('vice_chairman')->nullable();
            $table->string('vice_chairman_position')->nullable();
            $table->string('vice_chairman_office')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_selection_boards');
    }
};
