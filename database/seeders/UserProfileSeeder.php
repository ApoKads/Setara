<?php

namespace Database\Seeders;

use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Database\Seeders\DisabilityUserProfileSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        UserProfile::factory(5)->create();
        $this->call([DisabilityUserProfileSeeder::class]);
    }
}
