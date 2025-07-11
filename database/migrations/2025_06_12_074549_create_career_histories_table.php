<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('career_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_profile_id')->constrained('user_profiles')->cascadeOnDelete();
            $table->string('job_title');
            $table->string('company_name');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable(); // Bisa null jika masih bekerja
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_histories');
    }
};