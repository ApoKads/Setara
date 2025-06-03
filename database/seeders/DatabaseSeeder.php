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
use Illuminate\Support\Facades\Hash;
use App\Models\DisabilityUserProfile;
use Database\Seeders\UserProfileSeeder;

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

        // User::factory(10)->create();

        
        $this->call([UserProfileSeeder::class,AdminSeeder::class,CompanySeeder::class]);
        



        DisabilityUserProfile::factory()->create([
            'user_profile_id'=>1,
            'disability_id'=>1

        ]);
        DisabilityUserProfile::factory()->create([
            'user_profile_id'=>1,
            'disability_id'=>2

        ]);

        CategoryCompany::factory()->create([
            'company_id'=> 1,
            'category_id'=>2
        ]);

        CategoryCompany::factory()->create([
            'company_id'=> 2,
            'category_id'=>2
        ]);

        CategoryCompany::factory()->create([
            'company_id'=> 3,
            'category_id'=>1
        ]);

        CategoryCompany::factory()->create([
            'company_id'=> 4,
            'category_id'=>1
        ]);

        CategoryCompany::factory()->create([
            'company_id'=> 5,
            'category_id'=>1
        ]);

        CategoryCompany::factory()->create([
            'company_id'=> 5,
            'category_id'=>2
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
