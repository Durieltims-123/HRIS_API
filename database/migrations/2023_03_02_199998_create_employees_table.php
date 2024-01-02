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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained('divisions');
            $table->string('employee_id')->unique();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('suffix_name')->nullable();
            $table->string('contact_number');
            $table->string('email_address');
            $table->foreignId('lgu_position_id')->constrained('lgu_positions');
            $table->enum('employment_status', ['permanent', 'casual', 'coterminous', 'fixed term', 'contractual', 'substitute', 'provisional']);
            $table->string('employee_status');
            $table->string('orientation_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
