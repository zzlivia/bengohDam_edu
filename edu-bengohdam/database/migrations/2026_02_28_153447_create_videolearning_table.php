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
        Schema::create('videoLearning', function (Blueprint $table) {
            $table->id('videoLearningID');
            $table->foreignId('learningMaterialID')->constrained('learningMaterials', 'learningMaterialID')->onDelete('cascade');
            $table->string('videoLearningName');
            $table->text('videoLearningDesc')->nullable();
            $table->integer('videoLearningDuration'); // in seconds
            $table->string('videoLearningResolution');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videolearning');
    }
};
