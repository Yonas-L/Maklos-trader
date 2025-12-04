<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = config('products.items', []);

        foreach ($products as $item) {
            \App\Models\Product::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'name' => $item['name'],
                    'category' => $item['category'],
                    'excerpt' => $item['excerpt'],
                    'hero_image' => $item['hero_image'],
                    'secondary_image' => $item['secondary_image'],
                    'gallery' => $item['gallery'],
                    'description' => $item['description'],
                    'key_points' => $item['key_points'],
                    'sourcing' => $item['sourcing'],
                    'availability' => $item['availability'],
                ]
            );
        }
    }
}
