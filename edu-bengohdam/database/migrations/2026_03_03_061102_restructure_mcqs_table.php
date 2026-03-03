<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('mcqs', function (Blueprint $table) {

            // Drop lectID foreign key if exists
            $table->dropForeign(['lectID']);
            $table->dropColumn('lectID');

            // Add moduleID instead
            $table->unsignedBigInteger('moduleID')->after('moduleQs_ID');

            $table->foreign('moduleID')
                ->references('moduleID')
                ->on('module')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('mcqs', function (Blueprint $table) {
            $table->dropForeign(['moduleID']);
            $table->dropColumn('moduleID');
        });
    }
};
