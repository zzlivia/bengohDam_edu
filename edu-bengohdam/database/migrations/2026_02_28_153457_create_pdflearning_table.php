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
        Schema::create('pdfLearning', function (Blueprint $table) {
            $table->id('pdfLearningID');
            $table->foreignId('learningMaterialID')->constrained('learningMaterials', 'learningMaterialID')->onDelete('cascade');
            $table->string('pdfLearningName');
            $table->text('pdfLearningDesc')->nullable();
            $table->integer('pdfLearningPages');
            $table->float('pdfLearningSizes'); // in MB
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdflearning');
    }
};
