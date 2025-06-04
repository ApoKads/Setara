<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Company;
use App\Models\JobType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        JobType::factory(10)->create();
        Job::factory(100)->recycle([
            JobType::all(),
            Company::all(),
        ])->create();
    }
}
