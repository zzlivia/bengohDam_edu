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
        Schema::create('reports', function (Blueprint $table) {
            $table->id('reportID');
            $table->foreignId('generatedBy')
                ->constrained('admin', 'adminID')
                ->onDelete('cascade');

            $table->string('reportType'); // e.g., 'enrollment_summary', 'progress_report'
            $table->string('reportFilePath'); // path to the stored PDF/CSV file
            
            $table->timestamps(); // tracks when the report was generated
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
