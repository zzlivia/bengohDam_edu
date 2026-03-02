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
        Schema::table('learningmaterials', function (Blueprint $table) {
            $table->unsignedBigInteger('lectID')->after('learningMaterialID');

            $table->foreign('lectID')
                  ->references('lectID')
                  ->on('lecture')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('learningmaterials', function (Blueprint $table) {
            $table->dropForeign(['lectID']);
            $table->dropColumn('lectID');
        });
    }
};
