<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('career_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id');
            $table->string('job_title');
            $table->string('company');
            $table->date('start_date');
            $table->date('end_date')->nullable(); // boleh kosong kalau masih kerja
            $table->text('job_description')->nullable();
            $table->timestamps();

            // Foreign key (opsional, jika relasi antar tabel kamu atur)
            $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_histories');
    }
};
