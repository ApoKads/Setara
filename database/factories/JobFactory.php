<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\JobType;
use App\Models\Location;
use App\Models\Disability;
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
        // $table->id();
        //     $table->string('slug')->unique();
        //     $table->foreignId('company_id')->constrained('companies','id')->cascadeOnDelete();
        //     $table->string('name');
        //     $table->string('description');
        //     $table->float('wage');
        //     $table->string('location');
        //     $table->timestamps();
        return [
            //
            'slug'=>Str::slug(fake()->sentence()),
            'company_id'=>Company::factory(),
            'job_type_id'=>JobType::factory(),
            'location_id'=>Location::factory(),
            'education_level_id'=>EducationLevel::factory(),
            'disability_id'=>Disability::factory(),
            'name'=>fake()->name(),
            'description'=>fake()->paragraph(rand(10,40)),
            'wage'=>fake()->randomFloat(2,1000,10000),
        ];
    }
}
