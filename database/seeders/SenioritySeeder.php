<?php

namespace Database\Seeders;

use App\Models\Seniority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SenioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seniorities = [
            [
                'name' => 'Junior',
                'description' => 'Entry-level position with 0-2 years of experience',
                'level' => 1,
            ],
            [
                'name' => 'Mid-level',
                'description' => 'Intermediate position with 2-5 years of experience',
                'level' => 2,
            ],
            [
                'name' => 'Senior',
                'description' => 'Senior position with 5-8 years of experience',
                'level' => 3,
            ],
            [
                'name' => 'Lead',
                'description' => 'Leadership position with 8-12 years of experience',
                'level' => 4,
            ],
            [
                'name' => 'Principal',
                'description' => 'Principal position with 12+ years of experience',
                'level' => 5,
            ],
            [
                'name' => 'Chief',
                'description' => 'Executive level position with 15+ years of experience',
                'level' => 6,
            ],
        ];

        foreach ($seniorities as $seniority) {
            Seniority::create($seniority);
        }
    }
}
