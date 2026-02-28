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
        Schema::create('users', function (Blueprint $table) {
            $table->id('userID'); // primary Key
            $table->string('userName');
            $table->string('userEmail')->unique();
            $table->string('userPass');
            $table->string('userRePass');
            $table->tinyInteger('authenticated')->default(0); 
            //$table->string('userRole')->default('learner'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
