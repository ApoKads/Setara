<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('career_histories', function (Blueprint $table) {
            $table->id();

            // Kolom penghubung ke tabel user_profiles
            $table->foreignId('user_profile_id')->constrained()->onDelete('cascade');

            // Kolom-kolom untuk data riwayat karir
            $table->string('job_title');
            $table->string('company');
            $table->text('job_description')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable(); // Boleh kosong jika masih bekerja di sana

            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_histories');
    }
};