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
        // tracks title, type, storage location, etc of learning materials
        Schema::create('learningMaterials', function (Blueprint $table) {
            $table->id('learningMaterialID');
            $table->string('learningMaterialTitle');
            $table->text('learningMaterialDesc')->nullable();
            $table->string('learningMaterialType'); // 'video' or 'pdf'
            $table->string('storagePath'); // replaces learningMaterialStorage
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_materials');
    }
};
