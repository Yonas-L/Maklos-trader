<?php

namespace Database\Seeders;

use App\Models\HeroContent;
use Illuminate\Database\Seeder;

class HeroContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroContent::create([
            'title' => 'Eucalyptus-powered care for cleaner, healthier living.',
            'description' => 'Discover our portfolio of detergents and cosmetics crafted with natural botanicals and trusted science. Highlighting our signature eucalyptus-based soaps for homes and businesses across Ethiopia.',
            'button_primary_label' => 'Explore Products',
            'button_primary_url' => '#products',
            'button_secondary_label' => 'Chat on WhatsApp',
            'button_secondary_url' => 'https://wa.me/251931674207',
            'is_active' => true,
        ]);
    }
}
