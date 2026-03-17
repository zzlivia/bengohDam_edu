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
        Schema::create('assessment_results', function (Blueprint $table) {
            $table->bigIncrements('assResultID');

            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('moduleID');

            $table->integer('score');
            $table->enum('status', ['passed', 'failed']);

            $table->timestamps();

            $table->foreign('userID')
                ->references('userID')
                ->on('user')
                ->onDelete('cascade');

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
        Schema::dropIfExists('assessment_results');
    }
};
