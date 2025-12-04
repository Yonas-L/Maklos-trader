<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'slug' => $this->faker->slug(),
            'category' => $this->faker->word(),
            'excerpt' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'hero_image' => 'storage/assets/IMG_6745.JPG', // Default image
            'secondary_image' => null,
            'gallery' => [],
            'key_points' => [$this->faker->sentence(), $this->faker->sentence()],
            'sourcing' => ['title' => 'Sourcing', 'body' => 'Body'],
            'availability' => [['label' => 'Label', 'description' => 'Desc']],
        ];
    }
}
