<?php

namespace Database\Factories;

use App\Models\Seniority;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seniority>
 */
class SeniorityFactory extends Factory
{
    protected $model = Seniority::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $seniorities = [
            ['name' => 'Junior', 'level' => 1, 'description' => 'Entry-level position with 0-2 years of experience'],
            ['name' => 'Mid-level', 'level' => 2, 'description' => 'Intermediate position with 2-5 years of experience'],
            ['name' => 'Senior', 'level' => 3, 'description' => 'Senior position with 5-8 years of experience'],
            ['name' => 'Lead', 'level' => 4, 'description' => 'Leadership position with 8-12 years of experience'],
            ['name' => 'Principal', 'level' => 5, 'description' => 'Principal position with 12+ years of experience'],
            ['name' => 'Chief', 'level' => 6, 'description' => 'Executive level position with 15+ years of experience'],
        ];
        
        $seniority = $this->faker->randomElement($seniorities);
        
        return [
            'name' => $seniority['name'],
            'description' => $seniority['description'],
            'level' => $seniority['level'],
        ];
    }
}
