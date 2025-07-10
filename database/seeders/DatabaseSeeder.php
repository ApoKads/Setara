<?php

namespace Database\Seeders;

use App\Models\Job;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Admin;
// use App\Models\UserDisability;
use App\Models\Company;
use App\Models\Category;
use App\Models\Applicant;
use App\Models\Disability;
use App\Models\UserProfile;
use App\Models\CategoryCompany;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\LocationSeeder;
use Illuminate\Support\Facades\Hash;
use App\Models\DisabilityUserProfile;
use Database\Seeders\UserProfileSeeder;
use Database\Seeders\EducationLevelSeeder;

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

        Category::factory()->create([
            'name'=>'Perbankan',
            'color'=>'yellow'
        ]);

        Category::factory()->create([
            'name'=>'Jasa',
            'color'=>'red'
        ]);


        $this->call([LocationSeeder::class]);
        $this->call([EducationLevelSeeder::class]);
        $this->call([SenioritySeeder::class]);
        
        $this->call([UserProfileSeeder::class,AdminSeeder::class,CompanySeeder::class]);
    


        $this->call([JobSeeder::class,ApplicantSeeder::class]);

        $this->call(CompanyStatusSeeder::class);

        
    }
}
