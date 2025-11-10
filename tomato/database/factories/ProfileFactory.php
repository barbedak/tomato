<?php

namespace Database\Factories;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class ProfileFactory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'gender' => fake()->randomElement(['male', 'female']),
            'country' => fake()->country(),
            'birthed_at' => fake()->date(),
            'is_married' => fake()->randomElement([true, false]),
            'avatar' => fake()->realTextBetween(10, 20),
        ];
    }

}
