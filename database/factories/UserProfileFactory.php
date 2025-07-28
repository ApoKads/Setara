<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Schema::create('user_profiles', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->foreignId('user_id')->constrained('users','id')->cascadeOnDelete();
        //     $table->integer('age');
        //     $table->text('about');
        //     $table->timestamps();
        // });
        return [
            //
            'name' => fake()->name(),
            'slug'=>Str::slug(fake()->sentence()),
            'user_id' => User::factory(),
            'age' => fake()->numberBetween(18, 65),
            'about'=> fake()->paragraph(rand(10,40)),
            'profile_image'=>'default.jpg'

        ];
    }
}
