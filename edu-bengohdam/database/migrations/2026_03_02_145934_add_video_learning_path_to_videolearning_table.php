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
        Schema::table('videolearning', function (Blueprint $table) {
            $table->string('videoLearningPath')->after('videoLearningName');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videolearning', function (Blueprint $table) {
            $table->dropColumn('videoLearningPath');
        });
    }
};
