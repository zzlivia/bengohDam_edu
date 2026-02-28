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
        Schema::create('enrolmentCourseModules', function (Blueprint $table) {
            $table->id('enrolID');
            $table->foreignId('userID')->constrained('user', 'userID');
            $table->foreignId('courseID')->constrained('course', 'courseID');
            $table->boolean('isCompleted')->default(false);
            $table->boolean('inProgress')->default(true);
            $table->string('moduleID'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrolment_course_module');
    }
};
