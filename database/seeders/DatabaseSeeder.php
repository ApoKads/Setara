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

        Category::factory()->create([
            'name'=>'Perbankan',
            'color'=>'yellow'
        ]);

        Category::factory()->create([
            'name'=>'Jasa',
            'color'=>'red'
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
        User::factory()->create([
            'email' => 'testUser4@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'company'
        ]);
        User::factory()->create([
            'email' => 'testUser5@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'company'
        ]);
        User::factory()->create([
            'email' => 'testUser6@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'company'
        ]);
        User::factory()->create([
            'email' => 'testUser7@example.com',
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
            'location'=>'Jakarta Barat',
            'description'=>'lorem ipsum et dolor sit amet',
        ]);

        Company::factory()->create([
            'user_id'=>4,
            'name'=>'PT PEMIMPIN ASIA',
            'location'=>'Balikpapan',
            'description'=>'Datang tak diundang, pulang harus di bom',
        ]);

        Company::factory()->create([
            'user_id'=>5,
            'name'=>'PT CAHAYA YEDIJA',
            'location'=>'Depok',
            'description'=>'Anak Perusahaan dari perusahaan BG Corp dengan Alias Winion',
        ]);

        Company::factory()->create([
            'user_id'=>6,
            'name'=>'PT UNDRA SUKSES',
            'location'=>'Surabaya',
            'description'=>'Tim Sukses PPTI 18',

        ]);

        Company::factory()->create([
            'user_id'=>7,
            'name'=>'PT UNDRA SUKSES 2',
            'location'=>'Surabaya',
            'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur corporis nihil illo dolorem totam aliquid, quisquam commodi officiis dolores exercitationem, odio unde necessitatibus expedita itaque rerum, cum laudantium impedit minima eius. Assumenda architecto sequi sunt, quos, numquam, molestiae facere consequatur molestias perferendis aliquam alias laboriosam consequuntur quis porro harum saepe!',

        ]);


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
