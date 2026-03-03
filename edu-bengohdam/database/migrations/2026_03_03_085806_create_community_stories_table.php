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
        Schema::create('community_stories', function (Blueprint $table) {
            $table->id();
            $table->string('community_name');           // Person name
            $table->string('title');          // Short title
            $table->text('community_story');            // Full story
            $table->string('community_image')->nullable(); // Optional profile image
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_stories');
    }
};
