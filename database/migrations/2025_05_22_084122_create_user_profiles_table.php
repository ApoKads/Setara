<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->integer('age')->nullable();
            $table->text('about')->nullable();
            $table->text('description')->nullable();
            $table->string('job_status')->default('dan siap untuk bekerja!');
            $table->string('profile_image')->nullable();
            $table->string('quote')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
