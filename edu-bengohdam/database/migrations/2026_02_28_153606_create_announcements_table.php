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
        //
        Schema::create('announcements', function (Blueprint $table) {
            $table->id('announcementID');
            $table->string('announcementTitle');
            $table->longText('announcementDetails');
            $table->unsignedBigInteger('adminID')->constrained('admin', 'adminID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
