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
            $table->unsignedBigInteger('moduleID')->after('lectID');

            $table->foreign('moduleID')
                  ->references('moduleID')
                  ->on('module')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lecture', function (Blueprint $table) {
            $table->dropForeign(['moduleID']);
            $table->dropColumn('moduleID');
        });
    }
};
