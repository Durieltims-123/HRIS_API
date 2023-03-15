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
        Schema::create('psb_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personnel_selection_board_id')->constrained()->onDelete('cascade');
            $table->string('employee_id');
            $table->string('member_name');
            $table->string('member_position');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psb_members');
    }
};
