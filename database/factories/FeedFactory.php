<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feed>
 */
class FeedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'name' =>  fake()->word,
            'caption' => fake()->sentence,
            'like' => fake()->numberBetween(10, 1000),
            'comment' => fake()->numberBetween(10, 1000),
            'saved' => fake()->numberBetween(10, 1000),
        ];
    }
}
