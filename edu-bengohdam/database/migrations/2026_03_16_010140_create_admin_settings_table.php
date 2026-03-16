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
        Schema::create('admin_settings', function (Blueprint $table) {
            $table->id();
            $table->string('default_language')->nullable();
            $table->boolean('notifications')->default(1);
            $table->boolean('user_registration')->default(1);
            $table->boolean('guest_access')->default(0);
            $table->boolean('text_to_speech')->default(0);
            $table->string('font_size')->nullable();
            $table->boolean('announcements')->default(1);
            $table->string('export_format')->nullable();
            $table->string('allowed_file_types')->nullable();
            $table->string('max_file_size')->nullable();
            $table->string('video_resolution_limit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_settings');
    }
};
