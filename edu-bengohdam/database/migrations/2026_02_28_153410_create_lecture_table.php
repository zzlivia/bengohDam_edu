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
        // represents individual lessons within a module
        Schema::create('lecture', function (Blueprint $table) {
            $table->id('lectID');
            $table->foreignId('moduleID')->constrained('modules', 'moduleID')->onDelete('cascade');
            $table->string('lectName');
            
            // Add ->nullable() here
            $table->foreignId('learningMaterialID')
                ->nullable() 
                ->constrained('learning_materials', 'learningMaterialID')
                ->onDelete('set null'); // Keeps the lecture even if material is deleted

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecture');
    }
};
