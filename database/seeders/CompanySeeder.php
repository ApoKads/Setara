<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Category;
use App\Models\CategoryCompany;
use Illuminate\Database\Seeder;
use Database\Seeders\CategoryCompanySeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()->count(10)->create();

        $this->call([CategoryCompanySeeder::class]);
    }
}
