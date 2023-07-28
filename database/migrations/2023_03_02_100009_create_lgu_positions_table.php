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
        Schema::create('lgu_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained();
            $table->foreignId('position_id')->constrained();
            $table->string('item_number')->nullable();
            $table->string('place_of_assignment')->nullable();
            $table->enum('position_status', ['Permanent', 'Casual', 'Elective', 'Coterminous', 'Contractual']);
            $table->enum('status', ['Active', 'Abolished']);
            $table->integer('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lgu_positions');
    }
};
