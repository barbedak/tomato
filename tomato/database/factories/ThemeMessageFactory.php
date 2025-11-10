<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ThemeMessage>
 */
class ThemeMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => fake()->realTextBetween(200, 1000),
            'theme_id' => Theme::inRandomOrder()->first()->id,
            'profile_id' => Profile::inRandomOrder()->first()->id,
        ];
    }
}
