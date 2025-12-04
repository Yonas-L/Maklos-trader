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
            'title' => "Maklos Trading's Premium Soap Manufacturer",
            'description' => "Experience the perfect blend of natural ingredients and manufacturing precision with Maklos Trading's premium bathing soaps. Our signature Future Eucalyptus line delivers refreshing cleanliness with antibacterial benefits, while our OEM services help brands launch their own soap products with confidence and quality",
            'button_primary_label' => 'Explore Products',
            'button_primary_url' => '#products',
            'button_secondary_label' => 'Chat on WhatsApp',
            'button_secondary_url' => 'https://wa.me/251931674207',
            'is_active' => true,
        ]);
    }
}
