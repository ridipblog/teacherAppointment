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
        Schema::create('current_vecancy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schoolCode');
            $table->integer('remaingVacency')->default(0);

            $table->foreign('schoolCode')
                ->references('id')
                ->on('school_vacency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('current_vecancy');
    }
};
