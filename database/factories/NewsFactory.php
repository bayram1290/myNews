<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'name' => fake()->words(rand(5, 10), true),
            'description' => fake()->paragraph(15),
            'image' =>  'news_image/' . (fake()->randomElement([1,2,3,4,5,6]) . '.jpg'),
            'author' => 'superadmin',
            'created_at'=> fake()->date()
        ];
    }
}
