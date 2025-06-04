<?php

namespace Database\Seeders;

use App\Models\EducationLevel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        EducationLevel::factory()->create([
            'name'=>'SD/Sederajat'
        ]);
        EducationLevel::factory()->create([
            'name'=>'SMP/Sederajat'
        ]);
        EducationLevel::factory()->create([
            'name'=>'SMA/SMK/MA/Sederajat'
        ]);
        EducationLevel::factory()->create([
            'name'=>'Diploma (D1-D4)'
        ]);
        EducationLevel::factory()->create([
            'name'=>'Sarjana (S1)'
        ]);
        EducationLevel::factory()->create([
            'name'=>'Magister (S2)'
        ]);
        EducationLevel::factory()->create([
            'name'=>'Doktor (S3)'
        ]);
    }
}
