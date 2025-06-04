<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Category;
use App\Models\CategoryCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;



class CategoryCompanySeeder extends Seeder
{
    public function run()
    {
        // Clear the table first
        DB::table('category_company')->truncate();

        // Get all companies and categories
        $companies = Company::all();
        $categories = Category::all();

        // Check if we have enough data
        if ($companies->isEmpty() || $categories->isEmpty()) {
            $this->command->error('No companies or categories found! Please seed them first.');
            return;
        }

        $totalPossiblePairs = $companies->count() * $categories->count();
        $desiredCount = 100;

        // Adjust desired count if there aren't enough unique pairs
        if ($totalPossiblePairs < $desiredCount) {
            $this->command->warn("Only $totalPossiblePairs unique pairs possible. Adjusting count...");
            $desiredCount = $totalPossiblePairs;
        }

        $created = 0;
        $attempts = 0;
        $maxAttempts = $desiredCount * 2; // Prevent infinite loops
        $existingPairs = [];

        $this->command->info("Creating $desiredCount unique company-category relationships...");

        while ($created < $desiredCount && $attempts < $maxAttempts) {
            $company = $companies->random();
            $category = $categories->random();
            
            $pairKey = $company->id . '_' . $category->id;
            
            if (!isset($existingPairs[$pairKey])) {
                CategoryCompany::create([
                    'company_id' => $company->id,
                    'category_id' => $category->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                $existingPairs[$pairKey] = true;
                $created++;
                
                // Progress feedback
                if ($created % 10 === 0) {
                    $this->command->info("Created $created pairs...");
                }
            }
            
            $attempts++;
        }

        $this->command->info("Successfully created $created unique company-category relationships!");
        
        if ($created < $desiredCount) {
            $this->command->warn("Only created $created unique pairs out of requested $desiredCount.");
        }
    }
}
