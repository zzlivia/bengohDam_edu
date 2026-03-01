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
        Schema::table('course', function (Blueprint $table) {
            $table->string('courseLevel')->after('courseCategory'); // e.g., Beginner, Advanced
            $table->integer('courseDuration')->after('courseLevel'); // e.g., in hours or weeks
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course', function (Blueprint $table) {
            $table->dropColumn(['courseLevel', 'courseDuration']);
        });
    }
};
