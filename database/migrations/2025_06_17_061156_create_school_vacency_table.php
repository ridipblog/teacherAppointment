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
        Schema::create('school_vacency', function (Blueprint $table) {
            $table->id();
            $table->string('schoolCode')->uniqid();
            $table->string('schoolName');
            $table->string('district');
            $table->string('medium');
            $table->string('vacencyCategory');
            $table->integer('actualVacency');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_vacency');
    }
};
