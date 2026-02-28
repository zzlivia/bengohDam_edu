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
        Schema::create('moduleAns', function (Blueprint $table) {
            $table->id('ansID');
            $table->foreignId('moduleQs_ID')->constrained('mcqs', 'moduleQs_ID')->onDelete('cascade');
            $table->string('ansID_text'); // for actual answer content
            $table->tinyInteger('ansCorrect')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_ans');
    }
};
