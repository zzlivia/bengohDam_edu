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
        // stores metadata of courses 
        Schema::create('course', function (Blueprint $table) {
            $table->id('courseID');
            $table->string('courseCode')->unique();
            $table->string('courseName');
            $table->string('courseAuthor');
            $table->text('courseDesc');
            $table->string('courseCategory');
            $table->boolean('isAvailable')->default(true);
            $table->text('courseImg')->nullable(); // For your aesthetic project images
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
