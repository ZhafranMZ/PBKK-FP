<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'title' => Str::random(10),
            'name' =>  fake()->name(),
            'caption' => Str::random(20),
            'like' => fake()->numberBetween(10, 1000),
            'comment' => fake()->numberBetween(10, 1000),
            'saved' => fake()->numberBetween(10, 1000),
        ];
    }
}
