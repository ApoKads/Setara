<?php

namespace Database\Seeders;

use App\Models\Disability;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DisabilityUserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DisabilityUserProfileSeeder extends Seeder
{
    public function run()
    {
        // Clear the table first
        DB::table('disability_user_profile')->truncate();

        // Get all disabilities and user profiles
        $disabilities = Disability::all();
        $userProfiles = UserProfile::all();

        // Check if we have enough data
        if ($disabilities->isEmpty() || $userProfiles->isEmpty()) {
            $this->command->error('No disabilities or user profiles found! Please seed them first.');
            return;
        }

        $totalPossiblePairs = $disabilities->count() * $userProfiles->count();
        $desiredCount = max(100, $userProfiles->count()); // Ensure at least one per user profile

        // Adjust desired count if there aren't enough unique pairs
        if ($totalPossiblePairs < $desiredCount) {
            $this->command->warn("Only $totalPossiblePairs unique pairs possible. Adjusting count...");
            $desiredCount = $totalPossiblePairs;
        }

        $created = 0;
        $attempts = 0;
        $maxAttempts = $desiredCount * 3; // Increased attempts for more complex logic
        $existingPairs = [];
        $profilesWithDisabilities = [];

        $this->command->info("Creating $desiredCount unique disability-user profile relationships...");

        // First pass: Ensure each user profile gets at least one disability
        foreach ($userProfiles as $profile) {
            $disability = $disabilities->random();
            $pairKey = $disability->id . '_' . $profile->id;
            
            DisabilityUserProfile::create([
                'disability_id' => $disability->id,
                'user_profile_id' => $profile->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $existingPairs[$pairKey] = true;
            $profilesWithDisabilities[$profile->id] = true;
            $created++;
            
            if ($created % 10 === 0) {
                $this->command->info("Created $created pairs...");
            }
        }

        // Second pass: Fill remaining slots with random unique pairs
        while ($created < $desiredCount && $attempts < $maxAttempts) {
            $disability = $disabilities->random();
            $profile = $userProfiles->random();
            
            $pairKey = $disability->id . '_' . $profile->id;
            
            if (!isset($existingPairs[$pairKey])) {
                DisabilityUserProfile::create([
                    'disability_id' => $disability->id,
                    'user_profile_id' => $profile->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                $existingPairs[$pairKey] = true;
                $created++;
                
                if ($created % 10 === 0) {
                    $this->command->info("Created $created pairs...");
                }
            }
            
            $attempts++;
        }

        $this->command->info("Successfully created $created unique disability-user profile relationships!");
        
        // Verify all user profiles have at least one disability
        $profilesWithoutDisabilities = array_diff(
            $userProfiles->pluck('id')->toArray(),
            array_keys($profilesWithDisabilities)
        );
        
        if (!empty($profilesWithoutDisabilities)) {
            $this->command->error("Warning: Some user profiles have no disabilities: " . implode(', ', $profilesWithoutDisabilities));
        }
        
        if ($created < $desiredCount) {
            $this->command->warn("Only created $created unique pairs out of requested $desiredCount.");
        }
    }
}