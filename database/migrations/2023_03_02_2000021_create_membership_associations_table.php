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
        Schema::create('membership_associations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pds_id')->constrained('personal_data_sheets');
            $table->string('membership_association');
            $table->timestamps();

            // $table->foreign('pds_id')->references('id')->on('personal_data_sheets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_associations');
    }
};
