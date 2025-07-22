<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\JobType;
use App\Models\Location;
use App\Models\Disability;
use App\Models\Seniority;
use Illuminate\Support\Str;
use App\Models\EducationLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $minWage = 1000000;
        $maxWage = 50000000;
        $increment = 500000;

        $numberOfIncrements = ($maxWage - $minWage) / $increment;
        $randomIncrements = fake()->numberBetween(0, $numberOfIncrements);
        $wage = $minWage + ($randomIncrements * $increment);

        $workModes = ['Onsite', 'Remote', 'Onsite & Remote'];

        return [
            //
            'slug'=>Str::slug(fake()->sentence()),
            'company_id'=>Company::factory(),
            'job_type_id'=>JobType::factory(),
            'location_id'=>Location::factory(),
            'education_level_id'=>EducationLevel::factory(),
            'disability_id'=>Disability::factory(),
            'seniority_id'=>Seniority::factory(),
            'banner_image_path'=>'storage/job/BannerJob.jpeg',
            'name'=>fake()->name(),
            'description'=>fake()->paragraph(rand(10,40)),
            'responsibilities'=>fake()->paragraph(rand(10,40)),
            'wage'=>$wage,
            'slot'=>fake()->numberBetween(0,10),
            'work_mode' => fake()->randomElement($workModes),
        ];
    }
}
