<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Applicant;
use App\Models\UserProfile;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApplicantSeeder extends Seeder
{
    public function run(): void
    {
        Applicant::factory(100)->recycle([
            UserProfile::all(),
            Job::all()
            
        ])->create();

        // // Clear the table first
        // DB::table('applicants')->truncate();

        // // Get all jobs and user profiles
        // $jobs = Job::all();
        // $userProfiles = UserProfile::all();

        // // Check if we have enough data
        // if ($jobs->isEmpty() || $userProfiles->isEmpty()) {
        //     $this->command->error('No jobs or user profiles found! Please seed them first.');
        //     return;
        // }

        // $totalPossiblePairs = $jobs->count() * $userProfiles->count();
        // $desiredCount = 100;

        // // Adjust desired count if there aren't enough unique pairs
        // if ($totalPossiblePairs < $desiredCount) {
        //     $this->command->warn("Only $totalPossiblePairs unique pairs possible. Adjusting count...");
        //     $desiredCount = $totalPossiblePairs;
        // }

        // $created = 0;
        // $attempts = 0;
        // $maxAttempts = $desiredCount * 2; // Prevent infinite loops
        // $existingPairs = [];

        // $this->command->info("Creating $desiredCount unique job-user profile relationships...");

        // while ($created < $desiredCount && $attempts < $maxAttempts) {
        //     $job = $jobs->random();
        //     $userProfile = $userProfiles->random();
            
        //     $pairKey = $job->id . '_' . $userProfile->id;
            
        //     if (!isset($existingPairs[$pairKey])) {
        //         Applicant::create([
        //             'name'=>fake()->name(),
        //             'slug'=>Str::slug(fake()->sentence()),
        //             'job_id' => $job->id,
        //             'user_profile_id' => $userProfile->id,
        //             'note'=>fake()->paragraph(rand(10,40)),
        //             // Add any additional applicant fields here
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);
                
        //         $existingPairs[$pairKey] = true;
        //         $created++;
                
        //         // Progress feedback
        //         if ($created % 10 === 0) {
        //             $this->command->info("Created $created applicants...");
        //         }
        //     }
            
        //     $attempts++;
        // }

        // $this->command->info("Successfully created $created unique applicants!");
        
        // if ($created < $desiredCount) {
        //     $this->command->warn("Only created $created unique applicants out of requested $desiredCount.");
        // }
    }
}
