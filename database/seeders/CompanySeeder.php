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
        //

        Company::factory()->count(6)->create();

        $this->call([CategoryCompanySeeder::class]);


        // CategoryCompany::factory(100)->recycle([
        //     Company::all(),
        //     Category::all()
        // ])->create()->ensureUniqueRelationships(['company_id', 'category_id']);
    }
}
