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
        // handles the backend management by administrators
        Schema::create('admin', function (Blueprint $table) {
            $table->id('adminID');
            $table->string('adminName');
            $table->string('adminEmail')->unique();
            $table->string('adminPass'); // password
            $table->char('adminRole', 1)->default('A'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
