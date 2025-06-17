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
        Schema::create('candidate_data', function (Blueprint $table) {
            $table->id();
            $table->string('rollNumber');
            $table->string('post');
            $table->string('name');
            $table->string('fatherName');
            $table->string('address')->nullable();
            $table->string('district')->nullable();
            $table->string('medium')->nullable();
            $table->string('category')->nullable();
            $table->unsignedBigInteger('allocatedSchoolCode')->nullable();
            $table->tinyInteger('isAllocated')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_data');
    }
};
