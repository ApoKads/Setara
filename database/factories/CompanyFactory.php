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

        // Schema::create('companies', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained('users','id')->cascadeOnDelete();
        //     $table->string('slug')->unique();
        //     $table->string('name');
        //     $table->string('location');
        //     $table->text('description');
        //     $table->string('path_banner')->nullable();
        //     $table->string('path_logo')->nullable();
        //     $table->timestamps();
        // });
        return [
            //
            'user_id'=>User::factory()->state([
                'role' => 'company' // Pastikan role di-set sebagai company
            ]),
            'slug'=>Str::slug(fake()->sentence()),
            'name'=>fake()->company(),
            'location'=>fake()->city(),
            'description'=>fake()->paragraph(rand(10,40)),
            'path_banner'=>'company\BannerCompany.jpg',
            'path_logo'=>'company\logoCompany.png'
        ];
    }
}
