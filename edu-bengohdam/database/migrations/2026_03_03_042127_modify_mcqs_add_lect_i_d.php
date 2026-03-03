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
        Schema::table('mcqs', function (Blueprint $table) {

            $table->dropForeign(['moduleID']);
            $table->dropColumn('moduleID');

            $table->unsignedBigInteger('lectID')->after('moduleQs_ID');

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
        //
    }
};
