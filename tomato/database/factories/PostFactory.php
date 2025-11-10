<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realTextBetween(30, 255),
            'description' => fake()->realTextBetween(100, 500),
            'category_id' => Category::inRandomOrder()->first()->id,
            'profile_id' => Profile::inRandomOrder()->first()->id,
            'body' => fake()->realTextBetween(400, 1000),
            'published_at' => fake()->dateTime(),
            'views' => fake()->numberBetween(100, 1000),
            'is_published' => fake()->boolean(),
            'status' => fake()->numberBetween(100, 1000),
        ];
    }
}
