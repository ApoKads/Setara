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
    }
}
