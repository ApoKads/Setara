<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Company;
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

        Job::factory(100)->recycle([
            Company::all(),
        ])->create();
    }
}
