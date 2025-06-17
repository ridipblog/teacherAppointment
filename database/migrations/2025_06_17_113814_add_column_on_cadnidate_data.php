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
        Schema::table('candidate_data', function (Blueprint $table) {
            $table->string('subject')->nullable()->after('fatherName');
            $table->integer('pinCode')->nullable()->after('district');
            $table->unsignedBigInteger('generatedBy')->nullable();
            $table->dateTime('generatedOn')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_data', function (Blueprint $table) {
            //
        });
    }
};
