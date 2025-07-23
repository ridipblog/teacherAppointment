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
        Schema::create('vacency_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schoolCode');
            $table->string('post');
            $table->string('vacencyCode');
            $table->string('replcedPersion')->nullable()->comment('Name Of retired/Expired/Resigned/Transfered');

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
        Schema::dropIfExists('vacency_details');
    }
};
