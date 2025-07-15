<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\UserProfile;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Applicant>
 */
class ApplicantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $table->id();
        //     $table->string('name');
        //     $table->string('slug')->unique();
        //     $table->foreignId('user_profile_id')->constrained('user_profiles','id')->cascadeOnDelete();
        //     $table->foreignId('job_id')->constrained('jobs','id')->cascadeOnDelete();
        //     $table->text('note');
        //     $table->timestamps();
        return [
            //
            'slug'=>Str::slug(fake()->sentence()),
            'user_profile_id'=>UserProfile::factory(),
            'job_id'=>Job::factory(),
            'note'=>fake()->paragraph(rand(10,40)),
            'status'=>'Pending',
        ];
    }
}
