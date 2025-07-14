<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['pending', 'accepted', 'rejected'];

        return [
            'user_id' => User::factory()->state([
                'role' => 'company'
            ]),
            'slug' => Str::slug(fake()->company() . '-' . fake()->unique()->uuid()),
            'name' => fake()->company(),
            'location' => fake()->city(),
            'description' => fake()->paragraph(rand(10, 40)),
            'path_banner' => 'company/BannerCompany.jpg',
            'path_logo' => 'company/logoCompany.png',
            'status' => fake()->randomElement($statuses),
        ];
    }
}
