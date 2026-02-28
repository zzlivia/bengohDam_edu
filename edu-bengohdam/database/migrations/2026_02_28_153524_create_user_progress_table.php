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
        //
        Schema::create('userProgress', function (Blueprint $table) {
            $table->id('progressID');
            $table->foreignId('userID')->constrained('user', 'userID')->onDelete('cascade');
            $table->foreignId('courseID')->constrained('course', 'courseID')->onDelete('cascade');
            $table->string('progressName');
            $table->enum('progressStatus', ['not_started', 'in_progress', 'completed']);
            $table->integer('completionProgress')->default(0); // in percentage
            $table->timestamp('lastAccessed')->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_progress');
    }
};
