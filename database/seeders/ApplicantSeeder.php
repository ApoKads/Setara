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
        $userProfiles = UserProfile::inRandomOrder()->limit(10)->get();

        $jobs = Job::without([
            'company', 'JobType', 'location',
            'EducationLevel', 'disability', 'seniority'
        ])->inRandomOrder()->limit(10)->get();

        Applicant::factory(10)
            ->recycle($userProfiles)
            ->recycle($jobs)
            ->create();
    }


}
