<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CompanyStatusSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $positions = ['pending', 'accepted', 'rejected'];
        $statuses = ['waiting'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('company_statuses')->insert([
                'company_name' => $faker->unique()->company,
                'status'       => $faker->randomElement($statuses),
                'position'     => $faker->randomElement($positions),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
