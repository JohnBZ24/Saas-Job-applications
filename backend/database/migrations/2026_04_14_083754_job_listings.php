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
        Schema::create('job_listings',function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('organization_id')
          ->constrained('organization_profiles')
          ->cascadeOnDelete();

            $table->string('title');
            $table->text('description');
            $table->string('location')->nullable();
            $table->enum('type', ['full-time', 'part-time', 'contract', 'remote', 'internship','hybrid']);
            $table->string('salary_range')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'closed'])->default('pending');
            $table->date('deadline')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('job_listings');
    }
};
