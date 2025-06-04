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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignId('company_id')->constrained('companies','id')->cascadeOnDelete();
            $table->foreignId('job_type_id')->constrained('job_types','id')->cascadeOnDelete();
            $table->foreignId('location_id')->constrained('locations','id')->cascadeOnDelete();
            $table->foreignId('education_level_id')->constrained('education_levels','id')->cascadeOnDelete();
            $table->string('name');
            $table->string('description');
            $table->enum('work_location_type', ['onsite', 'remote', 'hybrid'])->default('onsite');
            $table->float('wage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
