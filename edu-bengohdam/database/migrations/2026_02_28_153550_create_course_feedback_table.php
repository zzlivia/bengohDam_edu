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
        //collect reviews
        Schema::create('courseFeedback', function (Blueprint $table) {
            $table->id('feedbackID');
            $table->foreignId('courseID')->constrained('course', 'courseID');
            $table->tinyInteger('courseRating'); // 1-5 scale
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_feedback');
    }
};
