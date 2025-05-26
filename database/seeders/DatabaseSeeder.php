<?php

namespace Database\Seeders;

use App\Models\Job;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Admin;
// use App\Models\UserDisability;
use App\Models\Company;
use App\Models\Applicant;
use App\Models\Disability;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\DisabilityUserProfile;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Disability::factory()->create([
            'name'=>'Tuna Daksa'
        ]);
        Disability::factory()->create([
            'name'=>'Tuna Netra'
        ]);
        // User::factory(10)->create();

        User::factory()->create([
            'email' => 'testUser@example.com',
            'email_verified_at' => now(),
            
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);
        User::factory()->create([
            'email' => 'testUser2@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
        User::factory()->create([
            'email' => 'testUser3@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'company'
        ]);

        UserProfile::factory()->create([
            'name' => 'Test User',
            'user_id' => 1,
            'age' => 17,
            'about' => 'saya seorang entusias woi'
        ]);
        
        Admin::factory()->create([
            'user_id'=>2
        ]);

        Company::factory()->create([
            'user_id'=>3,
            'name'=>'PT JAYA ABADI',
            'description'=>'lorem ipsum et dolor sit amet'
        ]);

        DisabilityUserProfile::factory()->create([
            'user_profile_id'=>1,
            'disability_id'=>1

        ]);
        DisabilityUserProfile::factory()->create([
            'user_profile_id'=>1,
            'disability_id'=>2

        ]);
        Job::factory()->create([
            'company_id'=>1,
            'name'=>'Bartender Gion',
            'description'=>'Tukang sushi nih boskyu',
            'wage' => 4351000,
            'location' =>'Market Lane'
        ]);

        Job::factory()->create([
            'company_id'=>1,
            'name'=>'Office Boy Aeon',
            'description'=>'Tukang Nyapu lantai 2 nih boskyu',
            'wage' => 2375000,
            'location' =>'AeonSentul'
        ]);

        Applicant::factory()->create([
            'user_profile_id'=> 1,
            'job_id'=>1,
            'note'=>'lorem ipsum et dolor semua kedetek',
        ]);
        Applicant::factory()->create([
            'user_profile_id'=> 1,
            'job_id'=>2,
            'note'=>'lorem ipsum et dolor semua kedetek',
        ]);
    }
}
