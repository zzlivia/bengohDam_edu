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
        Schema::table('lecture', function (Blueprint $table) {
            $table->dropForeign(['learningMaterialID']);
            $table->dropColumn('learningMaterialID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lecture', function (Blueprint $table) {
            //
        });
    }
};
