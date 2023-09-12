<?php

namespace Database\Factories;

use Illuminate\Support\Str;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(0);

        return [
            'title' => $title,
            'body' => $this->faker->sentence(0),
            'slug' => Str::slug($title),
        ];
    }

}